<?php

declare(strict_types=1);

namespace Bites\Foundation\Access\Concerns;

use App\Models\User;
use Bites\Foundation\Access\Entities\ModelAccessControl;

trait HasAccessControl
{
    public function accessControls()
    {
        return $this->morphMany(ModelAccessControl::class, 'model');
    }

    public function canRole(string $action, User $user): bool
    {
        $roleNames = $user->getRoleNames();

        return $this->accessControls()
            ->where('action', $action)
            ->whereIn('role', $roleNames)
            ->exists();
    }
}
