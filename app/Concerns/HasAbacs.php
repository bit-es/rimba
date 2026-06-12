<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Models\Support\Extra\Abac;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasAbacs
{
    /**
     * Polymorphic abacs relationship
     */
    public function abacs(): MorphToMany
    {
        return $this->morphToMany(Abac::class, 'abacable')
            ->withTimestamps();
    }

    /**
     * Get abac value by code
     */
    public function getAbac(string $code, mixed $default = null): mixed
    {
        $abac = $this->abacs
            ->firstWhere('code', $code);

        if (! $abac) {
            return $default;
        }

        return $this->castAbacValue($abac);
    }

    /**
     * Set (create or update) abac value
     */
    public function setAbac(
        string $code,
        mixed $value,
        ?string $valueType = null
    ): Abac {
        $valueType ??= $this->detectValueType($value);
        $serializedValue = $this->serializeValue($value, $valueType);

        // Search for both code AND value to decide if we update or create
        $abac = Abac::query()->updateOrCreate(
            [
                'code' => $code,
                'value' => $serializedValue,
            ],
            [
                'value_type' => $valueType,
            ]
        );

        $this->abacs()->syncWithoutDetaching([$abac->id]);

        return $abac;
    }

    /**
     * Check if abac exists
     */
    public function hasAbac(string $code): bool
    {
        return $this->abacs->contains('code', $code);
    }

    /**
     * Remove abac
     */
    public function removeAbac(string $code): void
    {
        $abac = $this->abacs->firstWhere('code', $code);

        if ($abac) {
            $this->abacs()->detach($abac->id);
        }
    }

    /**
     * Cast abac based on value_type
     */
    protected function castAbacValue(Abac $abac): mixed
    {
        return match ($abac->value_type) {
            'number' => +$abac->value,
            'boolean' => filter_var($abac->value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode((string) $abac->value, true),
            default => $abac->value,
        };
    }

    /**
     * Serialize value before storing
     */
    protected function serializeValue(mixed $value, string $type): string
    {
        return match ($type) {
            'json' => json_encode($value, JSON_UNESCAPED_UNICODE),
            'boolean' => $value ? '1' : '0',
            default => (string) $value,
        };
    }

    /**
     * Detect value type automatically
     */
    protected function detectValueType(mixed $value): string
    {
        return match (true) {
            is_bool($value) => 'boolean',
            is_int($value),
            is_float($value) => 'number',
            is_array($value) => 'json',
            default => 'string',
        };
    }
}
