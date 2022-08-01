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
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ramaroo');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ramaroo');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/form-builder.php' => config_path('ramaroo.php'),
            ], 'ramaroo-config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/ramaroo'),
            ], 'ramaroo-views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/ramaroo'),
            ], 'ramaroo-assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/ramaroo'),
            ], 'ramaroo-lang');

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
        $this->mergeConfigFrom(__DIR__.'/../config/form-builder.php', 'ramaroo');
    }

    protected function registerRoutes()
    {
        Route::group([
            'namespace' => 'Shopceed\FormBuilder\Http\Controllers',
            'middleware' => config('ramaroo.middleware'),
            'prefix' => 'api/ramaroo',
            'as' => 'api.',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
        Route::group([
            'namespace' => 'Shopceed\FormBuilder\Http\Controllers',
            'middleware' => config('ramaroo.middleware'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'namespace' => 'Shopceed\FormBuilder\Http\Controllers',
            'middleware' => config('ramaroo.middleware'),
        ];
    }

    protected function registerPolicies()
    {
        foreach (config('ramaroo.policies') as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
