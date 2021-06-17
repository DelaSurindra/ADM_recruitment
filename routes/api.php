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
Route::post("login","LoginController@login");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'auth:api'], function(){
	Route::post('/getSoal','TestController@getSoal');
	Route::post('/blokirPeserta', 'TestController@blockParticipant');
	Route::post('/submitTest','ScoringController@submitTest');
	Route::post('/getSubtestTime','TestController@getSubtesTime');
	Route::post('/submitStartTime','TestController@submitStartTime');
});