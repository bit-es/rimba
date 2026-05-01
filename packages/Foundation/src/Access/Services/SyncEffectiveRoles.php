<?php

declare(strict_types=1);

namespace Bites\Foundation\Access\Services;

use App\Models\User;

class SyncEffectiveRoles
{
    public static function handle(User $user): void
    {
        $roles = collect();
        // direct user roles
        $roles = $roles->merge($user->roles()->pluck('name'));
        // staff level
        if ($user->staff) {
            $roles = $roles->merge($user->staff->roles()->pluck('name'));
            // job position level
            if ($jp = $user->staff->jobPosition) {
                $roles = $roles->merge($jp->roles()->pluck('name'));
                // job role level
                if ($jp->jobRole) {
                    $roles = $roles->merge($jp->jobRole->roles()->pluck('name'));
                }
            }
        }

        dd($roles);
        $user->syncRoles($roles->unique()->values());
    }
}
