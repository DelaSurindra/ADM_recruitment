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

Route::get('/', 'FormContoller@sliderIndex')->name('slider');

Route::get('/{job}','FormContoller@form')->name('form');
Route::post('submit','FormContoller@submitLamaran')->name('submitLamaran');

Route::get("token",'RequestController@getToken');
Route::get("decrypt",'RequestController@testDecrypt');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
