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
Route::get('/', 'HomeController@HomeView')->name('home');

Route::get('/login', 'LoginController@loginAdminView')->name('get.login.view');
Route::post('/login-admin', 'LoginController@loginAdmin')->name('post.login-admin-vascomm');
Route::post('/process-reset-password-admin', 'Admin\LoginAdminController@resetPassAdmin')->name('post.reset-password-vascomm');
Route::get('/reset-password-admin', 'Admin\LoginAdminController@resetPassAdminView')->name('get.reset-password-vascomm.view');

Route::prefix('logout')->group(function () {
	Route::get('/', 'LoginController@logout')->name('get.logout');
});



