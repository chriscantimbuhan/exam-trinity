<?php

namespace App\Domain\Contact\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrations();
        $this->registerRouteKeys();
        $this->registerRoutes();
        $this->registerCommands();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }

    /**
     * Register model routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'middleware' => [
                'api',
                // 'auth',
            ]
        ], function () {
            $this->loadRoutesFrom(app_path('Domain/Contact/routes.php'));
        });
    }

    /**
     * Register route keys
     *
     * @return void
     */
    public function registerRouteKeys()
    {
        // 
    }

    /**
     * Register migrations.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(app_path('Domain/Contact/Migrations'));
    }

    /**
     * Register commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                // 
            ]);
        }
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        // 
    }
}
