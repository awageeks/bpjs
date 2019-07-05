<?php

namespace Awageeks\Bpjs;

use Illuminate\Support\ServiceProvider;

class BpjsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Awageeks\Bpjs\BpjsController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/bpjs.php' => config_path('bpjs.php'),
        ], 'config');

    }
}
