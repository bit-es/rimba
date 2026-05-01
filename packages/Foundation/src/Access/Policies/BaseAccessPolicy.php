<?php

declare(strict_types=1);

namespace Bites\Foundation\Access\Policies;

use App\Models\User;

class BaseAccessPolicy
{
    public function view(User $user, mixed $model): bool
    {
        return $model->canRole('view', $user);
    }

    public function update(User $user, mixed $model): bool
    {
        return $model->canRole('update', $user);
    }

    public function viewAny(User $user): bool
    {
        return true;
    }
}
