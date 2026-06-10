<?php

declare(strict_types=1);

namespace Bites\Business;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class BusinessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load migrations
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Register observers
        // \App\Models\Staff::observe(\Vendor\AccessControl\Observers\StaffObserver::class);
        // \App\Models\JobPosition::observe(\Vendor\AccessControl\Observers\JobPositionObserver::class);
        // \App\Models\JobRole::observe(\Vendor\AccessControl\Observers\JobRoleObserver::class);
    }
}
