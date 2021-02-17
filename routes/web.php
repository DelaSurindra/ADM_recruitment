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

Route::prefix('s')->group(function () {
	Route::post('/', 'Security\EncryptController@getPass')->name('s');
});

Route::prefix('news_event')->group(function () {
	Route::get('/', 'NewsEventController@viewNewsEvent')->name('get.news.event');
	Route::get('/add-news-event', 'NewsEventController@viewNewsEventAdd')->name('get.news.event.add');
	Route::post('/list-news-event','NewsEventController@listNewsEvent')->name('post.news.event.list');
	Route::post('/post-news-event','NewsEventController@addNewsEvent')->name('post.news.event.add');
	Route::get('/detail-news-event/{id}', 'NewsEventController@viewNewsEventDetail')->name('get.news.event.detail');
	Route::post('/edit-news-event','NewsEventController@editNewsEvent')->name('post.news.event.edit');
	Route::post('/delete-news-event','NewsEventController@deleteNewsEvent')->name('post.news.event.delete');
});

Route::prefix('vacancy')->group(function () {
	Route::get('/', 'VacancyController@viewVacancy')->name('get.vacancy');
	Route::post('/list-vacancy','VacancyController@listvacancy')->name('post.vacancy.list');
	Route::get('/add-vacancy', 'VacancyController@viewVacancyAdd')->name('get.vacancy.add');
	Route::post('/post-vacancy','VacancyController@addvacancy')->name('post.vacancy.add');
	Route::get('/detail-vacancy/{id}', 'VacancyController@viewvacancyDetail')->name('get.vacancy.detail');
	Route::post('/edit-vacancy','VacancyController@editvacancy')->name('post.vacancy.edit');
	Route::post('/delete-vacancy','VacancyController@deletevacancy')->name('post.vacancy.delete');
});

Route::prefix('logout')->group(function () {
	Route::get('/', 'LoginController@logout')->name('get.logout');
});



