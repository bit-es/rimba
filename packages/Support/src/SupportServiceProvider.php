<?php

declare(strict_types=1);

namespace Bites\Support;

use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    }
}
