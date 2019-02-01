<?php

namespace artemWC\HotfixMerge;

use Illuminate\Support\ServiceProvider;

class HotfixMergeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'artemwc');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'artemwc');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/hotfixmerge.php', 'hotfixmerge');

        // Register the service the package provides.
        $this->app->singleton('hotfixmerge', function ($app) {
            return new HotfixMerge;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hotfixmerge'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/hotfixmerge.php' => config_path('hotfixmerge.php'),
        ], 'hotfixmerge.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/artemwc'),
        ], 'hotfixmerge.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/artemwc'),
        ], 'hotfixmerge.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/artemwc'),
        ], 'hotfixmerge.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
