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

Route::group(['prefix' => 'pluranza'], function () {
	/*
	* ---------- Users ----------
	*/

	Route::get('usuarios/login', [
		'as' => 'pluranza.users.api.login',
		'uses' => '\Pluranza\SessionController@postLoginPluranza'
	]);


	Route::post('usuarios/login', [
		'as' => 'pluranza.users.api.login',
		'uses' => '\Pluranza\SessionController@postLogin'
	]);


	/*
	* ---------- Academies participants ----------
	*/
	Route::post('academias-participantes', [
		'before' => 'guest',
		'as' => 'pluranza.academies-participants.store',
		'uses' => '\Pluranza\AcademieParticipantController@store'
	]);

	Route::get('academias-participantes/editar/{id}', [
		'before' => 'guest',
		'as' => 'pluranza.academies-participants.edit',
		'uses' => '\Pluranza\AcademieParticipantController@edit'
	]);

	Route::patch('academias-participantes/update/{id}', [
		'before' => 'guest',
		'as' => 'pluranza.academies-participants.update',
		'uses' => '\Pluranza\AcademieParticipantController@update'
	]);
	/*
	 *
	 */

});