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


//====================================== INI ROUTE GROUP AUTH ============================================

Route::middleware(['web'])->group(function () {

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

});


//====================================== INI ROUTE GROUP ADMIN ============================================

Route::middleware(['auth', 'admin'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('home', 'HomeController@index')->name('home');

        //user admin management
        Route::get('user', 'Auth\UserController@getIndex')->name('listUser');
        Route::get('user/add', 'Auth\UserController@getAdd')->name('formUser');
        Route::get('user/block/{id}', 'Auth\UserController@getBlock');
        Route::get('user/active/{id}', 'Auth\UserController@getActive');
        Route::post('user/add', 'Auth\UserController@postAdd')->name('addUser');

        //edit profile
        Route::get('profile', 'ProfileController@getProfile')->name('profile');
        Route::post('profile/edit', 'ProfileController@postProfile')->name('editProfile');

        // Route admin pelamar
        Route::get('/pelamar', 'PelamarController@getIndex')->name('pelamar');
        Route::get('/pelamar/{id}', 'PelamarController@getDetailPelamar')->name('detailPelamar');
        Route::post('/pelamar/status/{id}', 'PelamarController@changeStatus');
        Route::get('/pelamar/download/{id}', 'PelamarController@getDownload')->name('download');
        Route::get('/pelamar/delete/{id}', 'PelamarController@pelamarDelete')->name('pelamarDelete');


        // Route admin Vacancy
        Route::get('/vacancy', 'VacancyController@getIndex')->name('vacancy');
        Route::get('/vacancy/add', 'VacancyController@getInput')->name('formAdd');
        Route::post('/vacancy/add', 'VacancyController@postInput')->name('submitJob');
        Route::get('/vacancy/{id}', 'VacancyController@getDetail');
        Route::get('/vacancy/edit/{id}', 'VacancyController@getEdit')->name('formEdit');
        Route::post('/vacancy/edit/{id}', 'VacancyController@postEdit');
        Route::get('/vacancy/delete/{id}', 'VacancyController@getDelete')->name('vacancyDelete');
        Route::get('/vacancy/role/{id}', 'VacancyController@updateRole')->name('updateRole');
    });

});


//====================================== INI ROUTE GROUP FORM APPLY ============================================

Route::middleware(['web'])->group(function () {

    //Halaman Apply
    Route::get('/', 'FormContoller@sliderIndex')->name('slider');
    Route::get('/{job}','FormContoller@detail')->name('detail');
    Route::post('submit','FormContoller@submitLamaran')->name('submitLamaran');
    Route::get('form/{job}','FormContoller@form')->name('form');

});
Route::view('/summernote','summernote');
Route::get("token",'RequestController@getToken');
Route::get("decrypt",'RequestController@testDecrypt');

