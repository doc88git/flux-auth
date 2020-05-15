<?php

namespace Doc88\Flux;

use Illuminate\Support\ServiceProvider;

class FluxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/flux.php' =>  config_path('flux.php'),
         ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}