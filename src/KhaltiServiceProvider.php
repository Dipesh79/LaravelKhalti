<?php

namespace Dipesh79\LaravelKhalti;

use Illuminate\Support\ServiceProvider;

class KhaltiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/khalti.php' => config_path('khalti.php'),
        ], 'config');
    }
}
