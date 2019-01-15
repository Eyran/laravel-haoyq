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
    return view('welcome', ['title' => 'laravel-haoyq']);
});


Route::get('get_cook_time/{date?}', 'IndexController@getCookTime');
Route::get('test', 'IndexController@test');// 测试

// 二维码
Route::get('print_qr', 'QrController@printQr');
Route::get('save_qr', 'QrController@saveQr');
Route::get('view_qr', function () {
    return view('qr');
});

// PDF
Route::get('print_pdf', 'PdfController@printPdf');
Route::get('download_pdf', 'PdfController@downloadPdf');
Route::get('load_file_pdf', 'PdfController@loadFilePdf');
Route::get('chain_methods', 'PdfController@chainMethods');

// Debugbar
Route::get('debugbar_view', 'DebugbarController@debugbarView');
Route::get('debugbar_log', 'DebugbarController@debugbarLog');

// 获取天气
Route::get('get_weather/{city?}', 'IndexController@getWeather');

// 测试 Redis
//Route::get('test_redis', 'IndexController@testRedis');
