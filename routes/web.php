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

Route::prefix('s')->group(function () {
	Route::post('/', 'Security\EncryptController@getPass')->name('s');
});

// Route::get('/', 'Admin\HomeController@HomeView')->name('home');

Route::prefix('HR')->group(function(){
	Route::prefix('logout')->group(function () {
		Route::get('/', 'Admin\LoginController@logout')->name('get.logout');
	});
	Route::prefix('login')->group(function () {
		Route::get('/', 'Admin\LoginController@loginAdminView')->name('get.login.view');
		Route::post('/login-admin', 'Admin\LoginController@loginAdmin')->name('post.login-admin');
	});
	Route::middleware('authuser')->group(function(){
		Route::get('/', 'Admin\HomeController@HomeView')->name('home.admin');
		Route::prefix('news_event')->group(function () {
			Route::get('/', 'Admin\NewsEventController@viewNewsEvent')->name('get.news.event');
			Route::get('/add-news-event', 'Admin\NewsEventController@viewNewsEventAdd')->name('get.news.event.add');
			Route::post('/list-news-event','Admin\NewsEventController@listNewsEvent')->name('post.news.event.list');
			Route::post('/post-news-event','Admin\NewsEventController@addNewsEvent')->name('post.news.event.add');
			Route::get('/detail-news-event/{id}', 'Admin\NewsEventController@viewNewsEventDetail')->name('get.news.event.detail');
			Route::post('/edit-news-event','Admin\NewsEventController@editNewsEvent')->name('post.news.event.edit');
			Route::post('/delete-news-event','Admin\NewsEventController@deleteNewsEvent')->name('post.news.event.delete');
		});
		
		Route::prefix('vacancy')->group(function () {
			Route::get('/', 'Admin\VacancyController@viewVacancy')->name('get.vacancy');
			Route::post('/list-vacancy','Admin\VacancyController@listVacancy')->name('post.vacancy.list');
			Route::get('/add-vacancy', 'Admin\VacancyController@viewVacancyAdd')->name('get.vacancy.add');
			Route::post('/post-vacancy','Admin\VacancyController@addVacancy')->name('post.vacancy.add');
			Route::get('/detail-vacancy/{id}', 'Admin\VacancyController@viewVacancyDetail')->name('get.vacancy.detail');
			Route::post('/edit-vacancy','Admin\VacancyController@editVacancy')->name('post.vacancy.edit');
			Route::post('/delete-vacancy','Admin\VacancyController@deleteVacancy')->name('post.vacancy.delete');
		});
	});
});


// Candidate View Preparation
Route::middleware('authcandidate')->group(function(){
	Route::get('/complete-account', 'Candidate\ProfileController@viewFirstLogin')->name('get.first-login');
	Route::post('/post-first-login', 'Candidate\ProfileController@postFirstLogin')->name('post.first-login');

	Route::prefix('signout')->group(function () {
		Route::get('/', 'Candidate\LoginController@logout')->name('get.logout-candidate');
	});
	Route::middleware('firstLogin')->group(function(){
		Route::prefix('profile')->group(function () {
			Route::get('/', 'Candidate\ProfileController@viewProfile')->name('get.profile.view');
			Route::get('/personal-information', 'Candidate\ProfileController@editPersonalInformation')->name('get.profile.personal-information');
			Route::post('/post-personal-information', 'Candidate\ProfileController@postEditPersonalInformation')->name('post.profile.personal-information');
			Route::get('/other-information', 'Candidate\ProfileController@editOtherInformation')->name('get.profile.other-information');
			Route::post('/post-other-information', 'Candidate\ProfileController@postEditOtherInformation')->name('post.profile.other-information');
			Route::get('/education-information', 'Candidate\ProfileController@editEducationInformation')->name('get.profile.education-information');
			Route::post('/post-education-information', 'Candidate\ProfileController@postEditEducationInformation')->name('post.profile.education-information');
	
			Route::post('/post-edit-password', 'Candidate\ProfileController@postEditPassword')->name('post.profile.edit-password');
	
			Route::get('/my-app-detail', 'Candidate\ProfileController@myAppDetail')->name('get.profile.my-app-detail');
		});
	});

	Route::prefix('job')->group(function () {
		Route::post('/post-edit-password', 'Candidate\ProfileController@postEditPassword')->name('post.profile.edit-password');
	});
});

Route::get('/', 'Candidate\LoginController@index')->name('home');

Route::get('/news-event', 'Candidate\NewsEventController@viewNewsEvent')->name('get.news.event.page');
Route::get('/news-event/detail/{id}', 'Candidate\NewsEventController@viewNewsEventDetail')->name('get.news.event.page.detail');
Route::post('/news-get-more', 'Candidate\NewsEventController@getMoreNews')->name('get.news.more');
Route::post('/event-get-more', 'Candidate\NewsEventController@getMoreEvent')->name('get.event.more');

Route::get('/job', 'Candidate\JobController@viewJob')->name('get.job.page');
Route::get('/job/detail/{id}', 'Candidate\JobController@viewJobDetail')->name('get.job.page.detail');
Route::post('/apply-job', 'Candidate\JobController@applyJob')->name('post.apply-job');

Route::post('/post-signup', 'Candidate\LoginController@signUp')->name('post.signup');
Route::post('/post-login', 'Candidate\LoginController@signIn')->name('post.login');

// Fitur Masih Belum Pasti
Route::get('/test-reschedule', 'Candidate\ProfileController@testReschedule')->name('get.profile.test-reschedule');
Route::get('/interview-reschedule', 'Candidate\ProfileController@interviewReschedule')->name('get.profile.interview-reschedule');