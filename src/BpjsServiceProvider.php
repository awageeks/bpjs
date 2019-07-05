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
        include __DIR__.'/routes.php';
    }
}
