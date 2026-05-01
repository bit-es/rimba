<?php

declare(strict_types=1);

namespace Bites\Foundation;

use Bites\Foundation\Access\Listeners\SyncUserRolesOnLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class FoundationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Register observers
        // \App\Models\Staff::observe(\Vendor\AccessControl\Observers\StaffObserver::class);
        // \App\Models\JobPosition::observe(\Vendor\AccessControl\Observers\JobPositionObserver::class);
        // \App\Models\JobRole::observe(\Vendor\AccessControl\Observers\JobRoleObserver::class);

        // Register login listener
        Event::listen(
            Login::class,
            SyncUserRolesOnLogin::class
        );
    }
}
