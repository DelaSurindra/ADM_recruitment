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

	Route::prefix('forget-password')->group(function (){
		Route::post('/', 'Admin\LoginController@forgetPassword')->name('post.forget.password');
		Route::get('/view-reset/{id}', 'Admin\LoginController@viewResetPassword')->name('get.reset.password');
		Route::post('/reset-password', 'Admin\LoginController@resetPassword')->name('post.reset.password');
	});

	Route::middleware('authuser')->group(function(){
		Route::get('/', 'Admin\HomeController@HomeView')->name('home.admin');
		Route::post('/chart-total-application', 'Admin\HomeController@chartTotalApplication')->name('post.chart.total.application');
		Route::post('/chart-application-source', 'Admin\HomeController@chartApplicationSource')->name('post.chart.application.source');
		Route::post('/top-score', 'Admin\HomeController@topScore')->name('post.top.score');
		Route::post('/candidate-pass', 'Admin\HomeController@candidatePass')->name('post.candidate.pass');
		Route::post('/average-score', 'Admin\HomeController@averageScore')->name('post.average.score');
		Route::post('/application-university', 'Admin\HomeController@applicationUniversity')->name('post.application.university');
		Route::post('/application-major', 'Admin\HomeController@applicationMajor')->name('post.application.major');
		Route::get('/download-dashboard/{date}', 'Admin\HomeController@downloadDashboard')->name('post.download.dashboard');

		Route::prefix('change-password')->group(function () {
			Route::get('/', 'Admin\HomeController@editPasswordView')->name('get.change-password');
			Route::post('/post-change-password', 'Admin\HomeController@editPassword')->name('post.change-password');
		});

		Route::prefix('homepage')->group(function () {
			Route::get('/', 'Admin\HomepageController@viewHomepage')->name('get.homepage');
			Route::post('/edit-color', 'Admin\HomepageController@editColor')->name('post.edit.color');
			Route::post('/add-banner', 'Admin\HomepageController@addBanner')->name('post.add.banner');
			Route::post('/edit-banner', 'Admin\HomepageController@editBanner')->name('post.edit.banner');
			Route::post('/delete-banner', 'Admin\HomepageController@deleteBanner')->name('post.delete.banner');
		});

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
			Route::post('/get-major','Admin\VacancyController@getMajor')->name('post.get.major');
		});

		Route::prefix('question_bank')->group(function () {
			Route::get('/', 'Admin\QuestionController@viewQuestionBank')->name('get.question-bank');
			Route::post('/list-question','Admin\QuestionController@listQuestion')->name('post.question.list');
			Route::get('/add-question-bank', 'Admin\QuestionController@viewQuestionBankAdd')->name('get.question.bank.add');
			Route::post('/post-question-bank','Admin\QuestionController@addQuestionBank')->name('post.question.bank.add');
			Route::get('/detail-question-bank/{id}', 'Admin\QuestionController@viewQuestionBankDetail')->name('get.question.bank.detail');
			Route::get('/edit-question-bank/{id}', 'Admin\QuestionController@viewQuestionBankEdit')->name('get.question.bank.edit');
			Route::post('/edit-question-bank','Admin\QuestionController@editQuestion')->name('post.question.bank.edit');
			Route::post('/delete-question-bank','Admin\QuestionController@deleteQuestion')->name('post.question.bank.delete');
		});
		
		Route::prefix('candidate')->group(function () {
			Route::get('/', 'Admin\CandidateController@viewCandidate')->name('get.candidate');
			Route::post('/list-candidate','Admin\CandidateController@listCandidate')->name('post.candidate.list');
			Route::get('/add-candidate', 'Admin\CandidateController@viewCandidateAdd')->name('get.candidate.add');
			Route::post('/post-add-candidate', 'Admin\CandidateController@addCandidate')->name('post.candidate.add');
			Route::get('/detail-candidate/{id}', 'Admin\CandidateController@viewCandidateDetail')->name('get.candidate.detail');
			Route::get('/edit-candidate/{id}', 'Admin\CandidateController@viewCandidateEdit')->name('get.candidate.edit');
			Route::post('/post-edit-candidate','Admin\CandidateController@editCandidate')->name('post.candidate.edit');
			Route::get('/download-file-bulk','Admin\CandidateController@downloadFile')->name('get.download.bulk');
			Route::post('/get-master','Admin\CandidateController@getMaster')->name('post.data.master');
			Route::post('/post-add-bulk','Admin\CandidateController@addBulk')->name('post.bulk.add.candidate');
			Route::get('/download-candidate', 'Admin\CandidateController@downloadCandidate')->name('get.download.candidate');
		});

		Route::prefix('job')->group(function () {
			Route::get('/', 'Admin\JobController@viewJob')->name('get.job');
			Route::post('/list-job','Admin\JobController@listJob')->name('post.job.list');
			Route::get('/edit-job/{id}', 'Admin\JobController@viewJobEdit')->name('get.job.edit');
			Route::post('/post-edit-job','Admin\JobController@editJob')->name('post.job.edit');
			Route::post('/post-bulk-update','Admin\JobController@bulkUpdate')->name('post.bulk.update.job');
			Route::post('/inventory-result','Admin\TestController@inventoryResult')->name('inventory.result');
			Route::get('/download-job/{data}','Admin\JobController@downloadJob')->name('get.download.job');
		});

		Route::prefix('test')->group(function () {
			Route::get('/', 'Admin\TestController@viewTest')->name('get.test');
			Route::post('/list-test','Admin\TestController@listTest')->name('post.test.list');
			Route::get('/add-test', 'Admin\TestController@viewTestAdd')->name('get.test.add');
			Route::post('/post-test','Admin\TestController@addTest')->name('post.test.add');
			Route::get('/detail-test/{id}', 'Admin\TestController@viewTestDetail')->name('get.test.detail');
			Route::get('/edit-test/{id}', 'Admin\TestController@viewTestEdit')->name('get.test.edit');
			Route::post('/post-edit-test','Admin\TestController@editTest')->name('post.test.edit');
			Route::post('/list-candidate','Admin\TestController@listCandidate')->name('post.candidate.list.choose');
			Route::post('/list-candidate-theday','Admin\TestController@listCandidateTheDay')->name('post.candidate.list.day');
			Route::post('/list-candidate-finish','Admin\TestController@listCandidateFinish')->name('post.candidate.list.finish');
			Route::post('/list-candidate-pick','Admin\TestController@listCandidatePick')->name('post.candidate.list.pick');
			Route::post('/add-candidate-test','Admin\TestController@addCandidateTest')->name('post.add.candidate.test');
			Route::post('/set-test-participant','Admin\TestController@setTestParticipant')->name('post.set.test.participant');
			Route::post('/set-absen-participant','Admin\TestController@setAbsenParticipant')->name('post.set.absen.participant');
			Route::post('/post-startEnd-test','Admin\TestController@startEndTest')->name('post.start.end.test');
			Route::post('/detail-reschedule','Admin\TestController@detailReschedule')->name('post.detail.reschedule');
			Route::post('/post-reschedule','Admin\TestController@postReschedule')->name('post.reschedule');
			Route::get('/view-result-test/{id}', 'Admin\TestController@viewResultTest')->name('get.test.result');
			Route::post('/inventory-result','Admin\TestController@inventoryResult')->name('inventory.result');
			Route::get('/download-result/{id}','Admin\TestController@downloadResult')->name('download.result');
			Route::post('/send-otp-one','Admin\TestController@sendOtpOne')->name('post.send.otp.one');
			Route::post('/send-otp-bulk','Admin\TestController@sendOtpBulk')->name('post.send.otp.bulk');
			Route::post('/send-email-result','Admin\TestController@sendEmailResult')->name('post.send.email.result');
			
		});
		
		Route::prefix('interview')->group(function () {
			Route::get('/', 'Admin\InterviewController@viewInterview')->name('get.interview');
			Route::post('/list-interview','Admin\InterviewController@listInterview')->name('post.interview.list');
			Route::get('/add-interview', 'Admin\InterviewController@viewInterviewAdd')->name('get.interview.add');
			Route::post('/post-add-interview','Admin\InterviewController@addInterview')->name('post.interview.add');
			Route::get('/edit-interview/{id}', 'Admin\InterviewController@viewInterviewEdit')->name('get.interview.edit');
			Route::post('/post-edit-interview','Admin\InterviewController@editInterview')->name('post.interview.edit');
			Route::post('/list-candidate-pick','Admin\InterviewController@listCandidatePick')->name('post.candidate.list.interview');
			Route::post('/update-status-interview','Admin\InterviewController@updateStatus')->name('post.update.status.interview');
			Route::post('/decline-interview','Admin\InterviewController@declineInterview')->name('post.decline.interview');
			Route::post('/acc-interview','Admin\InterviewController@accInterview')->name('post.acc.interview');
		});

		Route::prefix('master')->group(function () {
			Route::get('/', 'Admin\MasterController@viewMaster')->name('get.master');
			Route::post('/list-universitas','Admin\MasterController@listUniversitas')->name('post.universitas.list');
			Route::post('/list-major','Admin\MasterController@listMajor')->name('post.major.list');
			Route::post('/post-master','Admin\MasterController@addMaster')->name('post.master.add');
			Route::post('/edit-master','Admin\MasterController@editMaster')->name('post.master.edit');
			Route::post('/delete-master','Admin\MasterController@deleteMaster')->name('post.master.delete');
		});

		Route::middleware('role:1')->group(function(){
			Route::prefix('user')->group(function () {
				Route::get('/', 'Admin\UserController@viewUser')->name('get.user');
				Route::post('/list-user','Admin\UserController@listUser')->name('post.user.list');
				Route::get('/add-user', 'Admin\UserController@viewUserAdd')->name('get.user.add');
				Route::post('/post-user','Admin\UserController@addUser')->name('post.user.add');
				Route::get('/edit-user/{id}', 'Admin\UserController@viewUserEdit')->name('get.user.edit');
				Route::post('/edit-user','Admin\UserController@editUser')->name('post.user.edit');
				Route::post('/delete-user','Admin\UserController@deleteUser')->name('post.user.delete');
			});
		});

		Route::prefix('report')->group(function (){
			Route::get('/', 'Admin\ReportController@viewReport')->name('get.report');
			Route::post('/get-report', 'Admin\ReportController@getReport')->name('post.report');
			Route::get('/download-report/{date}', 'Admin\ReportController@downloadReport')->name('get.download.report');
		});

		Route::prefix('time-sub-test')->group(function (){
			Route::get('/', 'Admin\TimeSubTestController@viewTimeSubTest')->name('get.time-subtest');
			Route::post('/list-time-subtest', 'Admin\TimeSubTestController@listTimeSubTest')->name('post.time-subtest');
			Route::post('/edit-time-subtest', 'Admin\TimeSubTestController@editTimeSubTest')->name('post.edit.time-subtest');
		});
	});
});


// Candidate View Preparation
Route::middleware('authcandidate')->group(function(){

	Route::get('/complete-account', 'Candidate\ProfileController@viewFirstLogin')->name('get.first-login');
	Route::post('/post-first-login', 'Candidate\ProfileController@postFirstLogin')->name('post.first-login');
	Route::post('/master-education', 'EducationController@getAllData')->name('get.master-edu');
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
	
			Route::get('/edit-password', 'Candidate\ProfileController@viewEditPassword')->name('get.profile.edit-password');
			Route::post('/post-edit-password', 'Candidate\ProfileController@postEditPassword')->name('post.profile.edit-password');
	
			Route::get('/my-app', 'Candidate\ProfileController@myApp')->name('get.profile.my-app');
			Route::get('/my-app-detail/{id}', 'Candidate\ProfileController@myAppDetail')->name('get.profile.my-app-detail');
			Route::post('/check-test', 'Candidate\ProfileController@checkTest')->name('post.check.test');
			Route::post('/post-confirm-test', 'Candidate\ProfileController@postConfirmTest')->name('post.confirm.test');
			Route::get('/test-reschedule/{id}', 'Candidate\ProfileController@testReschedule')->name('get.profile.test-reschedule');
			Route::post('/post-reschedule-test', 'Candidate\ProfileController@postRescheduleTest')->name('post.reschedule.test');
			Route::post('/post-reschedule-wt', 'Candidate\ProfileController@postRescheduleWt')->name('post.reschedule.wt');
			
			Route::post('/check-interview', 'Candidate\ProfileController@checkInterview')->name('post.check.interview');
			Route::post('/post-confirm-interview', 'Candidate\ProfileController@postConfirmInterview')->name('post.confirm.interview');
			Route::get('/interview-reschedule/{id}', 'Candidate\ProfileController@interviewReschedule')->name('get.profile.interview-reschedule');
			Route::post('/post-reschedule-interview', 'Candidate\ProfileController@postRescheduleInterview')->name('post.reschedule.interview');

		});
	});

	Route::prefix('job')->group(function () {
		Route::post('/tell-me', 'Candidate\JobController@applyTellMe')->name('post.tell-me');
	});
});

Route::get('/', 'Candidate\HomeController@viewIndex')->name('home');
Route::get('/source-info', 'Candidate\JobController@getDataSouce')->name('get.list.source');

Route::get('/news-event', 'Candidate\NewsEventController@viewNewsEvent')->name('get.news.event.page');
Route::get('/news-event/detail/{id}', 'Candidate\NewsEventController@viewNewsEventDetail')->name('get.news.event.page.detail');
Route::post('/news-get-more', 'Candidate\NewsEventController@getMoreNews')->name('get.news.more');
Route::post('/event-get-more', 'Candidate\NewsEventController@getMoreEvent')->name('get.event.more');

Route::get('/job', 'Candidate\JobController@viewJob')->name('get.job.page');
Route::post('/job-more', 'Candidate\JobController@getJobList')->name('get.job.more');
Route::get('/job/detail/{id}', 'Candidate\JobController@viewJobDetail')->name('get.job.page.detail');
Route::post('/apply-job', 'Candidate\JobController@applyJob')->name('post.apply-job');

Route::post('/post-signup', 'Candidate\LoginController@signUp')->name('post.signup');
Route::post('/post-login', 'Candidate\LoginController@signIn')->name('post.login');
Route::post('/post-forget', 'Candidate\LoginController@fogetPassword')->name('post.forget');
Route::get('/reset-password/{username}', 'Candidate\LoginController@viewForgetPassword')->name('get.forget');
Route::post('/post-reset', 'Candidate\LoginController@doResetPass')->name('do.forget');

//FAQ
Route::get('/faq', 'Candidate\FaqController@viewFaq')->name('get.candidate.faq');

//CONTACT US
Route::get('/contact-us', 'Candidate\ContactUsController@viewContactUs')->name('get.candidate.contact-us');

//COMPANY PROFILE
Route::get('/company-profile', 'Candidate\CompanyProfileController@viewCompanyProfile')->name('get.candidate.company-profile');

Route::post('/get-color', 'Candidate\HomeController@getColor')->name('get.color');

Route::get('/test-email', 'Candidate\JobController@testEmail');