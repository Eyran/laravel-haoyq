<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('get_cook_time/{date?}', 'IndexController@getCookTime');
Route::get('test', 'IndexController@test');// 测试

// 二维码
Route::get('print_qr', 'QrController@printQr');
Route::get('save_qr', 'QrController@saveQr');
Route::get('view_qr', function () {
    return view('qr');
});

