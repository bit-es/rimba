<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BladeUI\Icons\Factory;
use App\Services\AuthOrchestrator;
use App\Services\BuiltInAuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthOrchestrator::class, function ($app) {
            return new AuthOrchestrator([
                // $app->make(\Rimba\LdapAuth\Services\LdapAuthService::class),
                $app->make(BuiltInAuthService::class),
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Blade Icons registry
        $this->callAfterResolving(Factory::class, function (Factory $factory): void {
            $factory->add('myicons', [
                'path' => base_path('/resources/svg'),
                'prefix' => 'myicon',
            ]);
        });
    }
}
