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
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    return view('welcome', ['message' => Cache::has('is_holiday:' . now()->format('Ymd')) ? 'Happy Holiday' : 'laravel-haoyq', 'title' => 'laravel-haoyq']);
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

// 秒杀
Route::get('create_list', 'RushToBuyController@createList');
Route::get('buy', 'RushToBuyController@buy');
Route::get('buy_success', 'RushToBuyController@buySuccess');

// 上传图片
Route::get('upload_show', function () {
    return view('upload/uploader');
});
Route::post('upload_pic', 'UploadController@uploadPic');
Route::post('upload_formal', 'UploadController@uploadFormal');
