<?php

declare(strict_types=1);

namespace Bites\Platform;

use Bites\Platform\Utility\ApiFetchCommand;
use Bites\Support\Helper\MergeConfigAction;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->make(MergeConfigAction::class)->execute(path: __DIR__.'/../config/bites.php', key: 'bites');
    }

    public function boot(): void
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                ApiFetchCommand::class,
            ]);
        }
    }
}
