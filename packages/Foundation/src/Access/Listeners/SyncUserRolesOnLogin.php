<?php

declare(strict_types=1);

namespace Bites\Foundation\Access\Listeners;

use Bites\Foundation\Access\Services\SyncEffectiveRoles;
use Illuminate\Auth\Events\Login;

class SyncUserRolesOnLogin
{
    public function handle(Login $event): void
    {
        SyncEffectiveRoles::handle($event->user);
    }
}
