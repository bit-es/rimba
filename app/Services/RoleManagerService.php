<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleManagerService
{
    public static function create(Model $model, string $prefix = 'a', string $code = 'code'): void
    {
        if (!isset($model->$code)) {
            return;
        }

        $prefix = self::resolvePrefix($model, $prefix);

        Role::firstOrCreate([
            'name' => self::makeName($model->$code, $prefix),
            'guard_name' => 'web',
        ]);
    }

    public static function update(Model $model, string $prefix = 'a', string $code = 'code'): void
    {

        if (!$model->wasChanged($code) && !$model->wasChanged($prefix)) {
            return;
        }

        // NEW values
        $newPrefix = self::resolvePrefix($model, $prefix);
        $newCode   = $model->$code;

        // OLD values
        $oldCode   = $model->getOriginal($code);
        $oldPrefix = self::resolveOldPrefix($model, $prefix);

        $oldName = self::makeName($oldCode, $oldPrefix);
        $newName = self::makeName($newCode, $newPrefix);

        dump($oldName, $newName, $newCode, $oldCode, $newPrefix, $oldPrefix);

        $role = Role::where('name', $oldName)->first();

        if ($role) {
            $role->update(['name' => $newName]);
        } else {
            // fallback
            self::create($model, $prefix, $code);
        }
    }

    public static function delete(Model $model, string $prefix = 'a', string $code = 'code'): void
    {
        if (!isset($model->$code)) {
            return;
        }

        $prefix = self::resolvePrefix($model, $prefix);

        Role::where('name', self::makeName($model->$code, $prefix))->delete();
    }

    // ------------------------
    // Helpers
    // ------------------------

    protected static function resolvePrefix(Model $model, string $prefix): string
    {
        // If prefix matches a model attribute, use its VALUE
        if (array_key_exists($prefix, $model->getAttributes())) {
            return (string) $model->getAttribute($prefix);
        }

        // Otherwise treat prefix as literal
        return $prefix;
    }

    protected static function resolveOldPrefix(Model $model, string $prefix): string
    {
        // If prefix matches a model attribute, use ORIGINAL value
        if (array_key_exists($prefix, $model->getAttributes())) {
            return (string) $model->getOriginal($prefix);
        }

        return $prefix;
    }

    protected static function makeName(string $code, string $prefix): string
    {
        return $prefix . '.' . $code;
    }
}
