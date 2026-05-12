<?php

declare(strict_types=1);

namespace Bites\Platform\Services;

use Spatie\Permission\Models\Role;

class RoleResolver
{
    public static function resolveId(string $roleName): ?int
    {
        return Role::where('name', $roleName)->value('id');
    }
}