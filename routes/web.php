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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'dashboardController@index');

//----------------dataadmin----------------//
Route::get('/dataadmin', 'dashboardController@dataadmin');

Route::get('/detaildataadmin/{id}', 'dashboardController@show');

Route::put('/updatedataadmin/{id}', 'dashboardController@update');

Route::delete('/deletedataadmin/{id}', 'dashboardController@destroy');

//----------------datauser----------------//
Route::get('/datamahasiswa', 'dashboardController@datamahasiswa');

//----------------lomba----------------//
Route::get('/data_lomba', 'lombaController@index');

Route::get('/tambah_lomba', 'lombaController@create');

Route::post('/postlomba', 'lombaController@store');

Route::get('/detaildatalomba/{id}', 'lombaController@show');

Route::put('/updatedatalomba/{id}', 'lombaController@update');

Route::delete('/deletedatalomba/{id}', 'lombaController@destroy');

//----------------jadwal----------------//
Route::get('/jadwal', 'jadwalController@index');

Route::get('/tambah_jadwal', 'jadwalController@create');

Route::post('/postjadwal', 'jadwalController@store');

Route::get('/detailjadwal/{id}', 'jadwalController@show');

Route::put('/updatejadwal/{id}', 'jadwalController@update');

Route::delete('/deletedatajadwal/{id}', 'jadwalController@destroy');

//----------------register----------------//
Route::get('/register', 'adminController@create');

Route::post('/postregister', 'adminController@store');

//----------------datakontak----------------//
Route::get('/datakontak', 'kontakController@index');

Route::get('/tambah_kontak', 'kontakController@create');

Route::post('/postkontak', 'kontakController@store');

Route::get('/detaildatakontak/{id}', 'kontakController@show');

Route::put('/updatedatakontak/{id}', 'kontakController@update');

Route::delete('/deletekontak/{id}', 'kontakController@destroy');

//----------------datakelas----------------//
Route::get('/datakelas', 'kelasController@index');

Route::get('/tambah_kelas', 'kelasController@create');

Route::post('/postkelas', 'kelasController@store');

Route::get('/detaildatakelas/{id}', 'kelasController@show');

Route::put('/updatedatakelas/{id}', 'kelasController@update');

Route::delete('/deletedatakelas/{id}', 'kelasController@destroy');

//----------------datascore---------------//
Route::get('/datascore', 'ScoreController@index');

Route::get('/tambah_score', 'ScoreController@create');

Route::get('/detaildatajadwal/{id}', 'ScoreController@show');

Route::post('/postscore', 'ScoreController@store');

Route::get('/detailscore/{id}', 'ScoreController@shows');

Route::put('/updatedatascore/{id}', 'ScoreController@update');

Route::delete('/deletescore/{id}', 'ScoreController@destroy');

//----------------datanews---------------//

Route::get('/datanews', 'NewsController@index');

Route::get('/tambah_news', 'NewsController@create');

Route::post('/postnews', 'NewsController@store');

Route::get('/detailnews/{id}', 'NewsController@show');

Route::put('/updatenews/{id}', 'NewsController@update');

Route::delete('/deletenews/{id}', 'NewsController@destroy');