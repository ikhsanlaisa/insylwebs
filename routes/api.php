<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {
    Route::post('/register', 'ApiRegisterController@register');
    Route::post('/login', 'ApiRegisterController@login');
    Route::post('/recover', 'ApiLoginController@recover');
    Route::get('/score', 'ApiScoreController@score');
    Route::get('/kontak', 'ApiKontakController@kontak');
    Route::get('/user', 'ApiUsersController@index');
    Route::get('/news', 'ApiNewsController@news');
    Route::get('/kelas', 'ApiKelasController@kelas');
    Route::get('/jadwal', 'ApiJadwalController@jadwal');
    Route::get('/detailnews', 'ApiNewsController@show');
    Route::post('/regis', 'ApiScoreController@regis');
    Route::post('/updateuser', 'ApiUsersController@update');
});
