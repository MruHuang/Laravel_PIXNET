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
/*
Route::get('/', function () {
   // return view('HomePage');
   
});
*/
//Route::pattern('GuessNumber','s[0-9]{4}');

Route::get('/', 'GuessNumberController@RepeatGame');

Route::get('Guess/{Guess?}',[ 
	'as'=>'restartGame',
	'uses'=>'GuessNumberController@RepeatGame'
]);

Route::get('Download/{Guess?}/{GuessNumber}/{Anshistory}',[ 
	'as'=>'Download',
	'uses'=>'GuessNumberController@Download'
]);

Route::post('{Guess}/{GuessNumber}/{Anshistory}',[
	'as'=>'GetAns',
	'uses'=>'GuessNumberController@postAns'
]);