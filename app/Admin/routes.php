<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    Route::group(['prefix' => 'database', 'namespace' => 'Database'], function ($route) {
        $route->resource('faker_user', 'FakerUserController');
        $route->resource('browse_log', 'BrowseLogController');
    });
});
