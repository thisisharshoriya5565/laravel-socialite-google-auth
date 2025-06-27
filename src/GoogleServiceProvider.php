<?php

namespace Vendor\GoogleAuth;

use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/services.php', 'services');

        $this->publishes([
            __DIR__.'/config/services.php' => config_path('services.php'),
        ], 'google-auth-config');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register()
    {
        //
    }
}
