<?php

namespace App\Providers;

use App\Service\Weather\Xinzhi;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 天气
        $this->app->bind('App\Contracts\Weather', function() {
            return new Xinzhi();
        });
    }
}
