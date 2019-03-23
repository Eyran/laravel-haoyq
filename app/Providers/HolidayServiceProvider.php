<?php

namespace App\Providers;

use App\Service\Holiday\Goseek;
use Illuminate\Support\ServiceProvider;

class HolidayServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Contracts\Holiday', function () {
            return new Goseek();
        });
    }
}
