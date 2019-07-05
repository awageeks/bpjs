<?php

namespace Awageeks\Bpjs;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class BpjsServiceProvider extends BaseServiceProvider
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
        $configPath = __DIR__ . '/../config/bpjs.php';
        $this->publishes([$configPath => config_path('bpjs.php')], 'config');

        $this->app->bind('bpjs', function($app)
        {
            return new Bpjs();
        });
        $this->app->alias('bpjs', 'Awageeks\Bpjs\Bpjs');
    }
}
