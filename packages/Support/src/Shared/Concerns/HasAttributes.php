<?php

declare(strict_types=1);

namespace Bites\Support\Shared\Concerns;

use Bites\Support\Shared\Entities\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasAttributes
{
    /**
     * Polymorphic attributes relationship
     */
    public function extras(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable')
            ->withTimestamps();
    }

    /**
     * Get extra value by code
     */
    public function getExtra(string $code, mixed $default = null): mixed
    {
        $attribute = $this->extras
            ->firstWhere('code', $code);

        if (! $attribute) {
            return $default;
        }

        return $this->castExtraValue($attribute);
    }

    /**
     * Set (create or update) extra value
     */
public function setExtra(
    string $code,
    mixed $value,
    ?string $valueType = null
): Attribute {
    $valueType ??= $this->detectValueType($value);
    $serializedValue = $this->serializeValue($value, $valueType);

    // Search for both code AND value to decide if we update or create
    $attribute = Attribute::query()->updateOrCreate(
        [
            'code'  => $code,
            'value' => $serializedValue,
        ],
        [
            'value_type' => $valueType,
        ]
    );

    $this->extras()->syncWithoutDetaching([$attribute->id]);

    return $attribute;
}


    /**
     * Check if extra exists
     */
    public function hasExtra(string $code): bool
    {
        return $this->extras->contains('code', $code);
    }

    /**
     * Remove extra
     */
    public function removeExtra(string $code): void
    {
        $attribute = $this->extras->firstWhere('code', $code);

        if ($attribute) {
            $this->extras()->detach($attribute->id);
        }
    }

    /**
     * Cast extra based on value_type
     */
    protected function castExtraValue(Attribute $attribute): mixed
    {
        return match ($attribute->value_type) {
            'number'  => +$attribute->value,
            'boolean' => filter_var($attribute->value, FILTER_VALIDATE_BOOLEAN),
            'json'    => json_decode((string) $attribute->value, true),
            default   => $attribute->value,
        };
    }

    /**
     * Serialize value before storing
     */
    protected function serializeValue(mixed $value, string $type): string
    {
        return match ($type) {
            'json'    => json_encode($value, JSON_UNESCAPED_UNICODE),
            'boolean' => $value ? '1' : '0',
            default   => (string) $value,
        };
    }

    /**
     * Detect value type automatically
     */
    protected function detectValueType(mixed $value): string
    {
        return match (true) {
            is_bool($value)  => 'boolean',
            is_int($value),
            is_float($value) => 'number',
            is_array($value) => 'json',
            default          => 'string',
        };
    }
}