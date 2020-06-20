<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'crud'], function () {
    Route::get('/', 'BiodataController@index');
    Route::get('/tampil', 'BiodataController@tampil');
    Route::post('/ambil', 'BiodataController@ambil');
    Route::post('/tambah', 'BiodataController@tambah');
    Route::post('/ubah', 'BiodataController@ubah');
    Route::post('/hapus', 'BiodataController@hapus');
});
