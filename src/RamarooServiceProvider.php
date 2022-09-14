<?php

namespace Shopceed\FormBuilder;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Shopceed\FormBuilder\Commands\InstallCommand;

class RamarooServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'form-builder');
//        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/form-builder.php' => config_path('form-builder.php'),
            ], 'form-builder-config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/form-builder'),
            ], 'form-builder-views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../dist' => public_path('vendor/form-builder'),
            ], 'form-builder-assets');

            // Registering package commands.
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $this->registerRoutes();
        $this->registerPolicies();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/form-builder.php', 'form-builder');
        $this->app->make('Shopceed\FormBuilder\Seeds\DefaultDatabaseSeeder');
    }

    protected function registerRoutes()
    {
        Route::group([
            'namespace' => 'Shopceed\FormBuilder\Http\Controllers',
            'middleware' => config('form-builder.middleware'),
            'prefix' => 'api/form-builder',
            'as' => 'api.',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
        Route::group([
            'namespace' => 'Shopceed\FormBuilder\Http\Controllers',
            'middleware' => config('form-builder.middleware'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        Route::group([
            'namespace' => 'Shopceed\FormBuilder\Http\Controllers',
            'prefix' => 'api/form-builder',
            'as' => 'api.',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/guestapi.php');
        });

        Route::group([
            'namespace' => 'Shopceed\FormBuilder\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/guest.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'namespace' => 'Shopceed\FormBuilder\Http\Controllers',
            'middleware' => config('form-builder.middleware'),
        ];
    }

    protected function registerPolicies()
    {
        foreach (config('form-builder.policies') as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
