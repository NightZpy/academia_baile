<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
* ---------- User auth, register routes ----------
*/
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


/*
* ---------- Home routes ----------
*/
Route::get('/', [ 'as' => 'home', function () {
    return view('layout.main');
}]);

Route::post('/send-message', function() {
	return 'true';
});

Route::group(['prefix' => 'pluranza'], function () {
	/*
	* ---------- Academies participants ----------
	*/
	Route::post('usuarios/login', [
		'as' => 'users.api.login',
		'uses' => 'SessionController@postLogin'
	]);


	/*
	* ---------- Academies participants ----------
	*/
	Route::post('academias-participantes', [
		'before' => 'guest',
		'as' => 'academies-participants.register-base',
		'uses' => 'AcademieParticipantController@store'
	]);	

});
