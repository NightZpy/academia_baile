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
* ---------- Home routes ----------
*/
Route::get('/', [ 'as' => 'home', function () {
    return view('pages.index');
}]);

Route::post('/send-message', function() {
	return 'true';
});

/*
* ---------- Estates ----------
*/
Route::get('estados', function () {
	return response()->json(\App\Estate::all()->lists('estado', 'id_estado'));
});

Route::get('municipios/por-estado/{id}', function ($id) {
	return response()->json(\App\Estate::find($id)->municipalities->lists('name', 'id'));
});

Route::get('parroquias/por-municipio/{id}', function ($id) {
	return response()->json(\App\Municipality::find($id)->parishes->lists('name', 'id'));
});

Route::get('ciudades/por-estado/{id}', function ($id) {
	return response()->json(\App\Estate::find($id)->cities->lists('name', 'id'));
});

/*
* ---------- Users ----------
*/
Route::get('usuarios/login', [
	'as' => 'users.login',
	'uses' => 'SessionController@login'
]);

Route::post('usuarios/api/login', [
	'as' => 'users.api.login',
	'uses' => 'SessionController@postApiLogin'
]);

Route::post('usuarios/login', [
	'as' => 'users.login',
	'uses' => 'SessionController@postLogin'
]);

Route::get('usuarios/logout', [
	'as' => 'users.logout',
	'uses' => 'SessionController@logout'
]);

Route::get('usuarios/confirmar/{token}', [
	'as' => 'users.confirm',
	'uses' => 'SessionController@confirm'
]);

Route::get('/pluranza/usuarios/confirmar/{token}', [
	'as' => 'pluranza.users.confirm',
	'uses' => 'RegistrationController@confirmPluranza'
]);

Route::group(['prefix' => 'pluranza', 'namespace' => 'Pluranza', 'middleware' => 'auth'], function () {
	/*
	* ---------- Page index ----------
	*/
	Route::get('/', [
		'as' => 'pluranza.index',
		'uses' => 'PagesController@index'
	]);

	/*
	* ---------- Academies participants ----------
	*/
	Route::post('academias-participantes', [
		'as' => 'pluranza.academies-participants.store',
		'uses' => 'AcademieParticipantController@store'
	]);

	Route::get('academias-participantes/editar/{id}', [
		'as' => 'pluranza.academies-participants.edit',
		'uses' => 'AcademieParticipantController@edit'
	]);

	Route::patch('academias-participantes/update/{id}', [
		'as' => 'pluranza.academies-participants.update',
		'uses' => 'AcademieParticipantController@update'
	]);
});