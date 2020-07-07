<?php

namespace Doc88\FluxEntityPermission;

use Illuminate\Support\ServiceProvider;

class FluxEntityPermissionServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
    }
}
