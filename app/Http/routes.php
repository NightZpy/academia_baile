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
    return view('public.index');
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

/*
 * ---------- Pluranza ----------
 */
Route::group(['prefix' => 'pluranza', 'namespace' => 'Pluranza'], function () {

	/*
	* ---------- Page index ----------
	*/
	Route::get('/', [
		'as' => 'pluranza.home',
		'uses' => 'PagesController@index'
	]);

	Route::post('academias', ['middleware' => 'guest', 'as' => 'pluranza.academies.store', 'uses' => 'AcademyController@store']);

	Route::group(['middleware' => 'auth'], function () {

		/*
		* ---------- Academies participants ----------
		*/
		Route::group(['prefix' => 'academias-participantes'], function () {

			Route::get('editar/{id}', ['as' => 'pluranza.academies.edit', 'uses' => 'AcademyController@edit']);

			Route::patch('actualizar/{id}', ['as' => 'pluranza.academies.update', 'uses' => 'AcademyController@update']);
		});

		/*
		* ---------- Dancers ----------
		*/
		Route::group(['prefix' => 'bailarines'], function () {
			Route::get('/', [
				'as' => 'pluranza.dancers.home',
				'uses' => 'DancerController@index'
			]);

			Route::get('lista/{id}', [
				'as' => 'pluranza.dancers',
				'uses' => 'DancerController@index'
			]);

			Route::get('api/lista', [
				'as' => 'pluranza.dancers.api.list',
				'uses' => 'DancerController@apiList'
			]);

			Route::get('{id}', [
				'as' => 'pluranza.dancers.by-academy',
				'uses' => 'DancerController@byAcademy'
			]);

			Route::get('api/lista/{id}', [
				'as' => 'pluranza.dancers.api.by-academy',
				'uses' => 'DancerController@apiByAcademyList'
			]);

			Route::get('nuevo/{id}', [
				'as' => 'pluranza.dancers.new',
				'uses' => 'DancerController@create'
			]);

			Route::post('/', [
				'as' => 'pluranza.dancers.store',
				'uses' => 'DancerController@store'
			]);

			Route::get('ver/{id}', ['as' => 'pluranza.dancers.show', 'uses' => 'DancerController@show']);

			Route::get('editar/{id}', ['as' => 'pluranza.dancers.edit', 'uses' => 'DancerController@edit']);

			Route::patch('actualizar/{id}', ['as' => 'pluranza.dancers.update', 'uses' => 'DancerController@update']);

			Route::delete('{id}', ['as' => 'pluranza.dancers.delete', 'uses' => 'DancerController@destroy']);

		});
	});
});