<?php

namespace kujjs\imageManager;

use Illuminate\Support\ServiceProvider;

class imageManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/image-manager.php' => config_path('imageManager.php'),
            ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['ImageManager'] = $this->app->share(function($app)
        {
            return new imageManager;
        });
        
        // Register Facade
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Image', 'kujjs\imageManager\Facades\ImageManager');
        });
    }
}