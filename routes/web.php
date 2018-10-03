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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pelamar', 'PelamarController@getIndex')->name('pelamar');
Route::get('/pelamar/{id}', 'PelamarController@getDetailPelamar')->name('detailPelamar');
Route::get('/pelamar/download/{id}', 'PelamarController@getDownload')->name('download');


Route::get('/', 'FormContoller@sliderIndex')->name('slider');

Route::get('/{job}','FormContoller@form')->name('form');
Route::post('submit','FormContoller@submitLamaran')->name('submitLamaran');

Route::get("token",'RequestController@getToken');
Route::get("decrypt",'RequestController@testDecrypt');

// Auth::routes();
