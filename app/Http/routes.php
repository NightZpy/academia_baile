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
* ---------- Maintenance Mode routes ----------
*/

Route::get('/test', function() {
	return asset('assets/images/emails/logo.png');
});


Route::group(array('middleware' => 'auth', 'prefix' => 'admin'), function()
{
	Route::get('down-app', function()
	{
		touch(storage_path().'/meta/my.down');
	});

	Route::get('up-app', function()
	{
		@unlink(storage_path().'/meta/my.down');
	});
});

/*
* ---------- Home routes ----------
*/
Route::get('/', [ 'as' => 'home', function () {
    return view('public.index');
}]);

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
	'middleware' => 'auth',
	'as' => 'users.logout',
	'uses' => 'SessionController@logout'
]);

Route::get('usuarios/confirmar/{token}', [
	'as' => 'users.confirm',
	'uses' => 'SessionController@confirm'
]);

/*
 * ---------- Pluranza ----------
 */
Route::get('/pluranza/usuarios/confirmar/{token}', [
	'as' => 'pluranza.users.confirm',
	'uses' => 'RegistrationController@confirmPluranza'
]);

/*
 * ---------- Admin ----------
 */
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
	/*
	 * ---------- Categorias ----------
	 */
	Route::group(['prefix' => 'categorias'], function () {
		Route::get('/', ['as' => 'categories.home', 'uses' => 'CategoryController@index']);
		Route::get('nueva', ['as' => 'categories.new', 'uses' => 'CategoryController@create']);
		Route::post('/', ['as' => 'categories.store', 'uses' => 'CategoryController@store']);
		Route::get('ver/{id}', ['as' => 'categories.show', 'uses' => 'CategoryController@show']);
		Route::get('editar/{id}', ['as' => 'categories.edit', 'uses' => 'CategoryController@edit']);
		Route::patch('actualizar/{id}', ['as' => 'categories.update', 'uses' => 'CategoryController@update']);
		Route::delete('{id}', ['as' => 'categories.delete', 'uses' => 'CategoryController@destroy']);

		// -------------- API's --------------------
		Route::get('api/lista', ['as' => 'categories.api.list', 'uses' => 'CategoryController@apiList']);
	});

	/*
	 * ---------- Niveles ----------
	 */
	Route::group(['prefix' => 'niveles'], function () {
		Route::get(     '/',                ['as' => 'levels.home',     'uses' => 'LevelController@index']);
		Route::get(     'nuevo',            ['as' => 'levels.new',      'uses' => 'LevelController@create']);
		Route::post(    '/',                ['as' => 'levels.store',    'uses' => 'LevelController@store']);
		Route::get(     'ver/{id}',         ['as' => 'levels.show',     'uses' => 'LevelController@show']);
		Route::get(     'editar/{id}',      ['as' => 'levels.edit',     'uses' => 'LevelController@edit']);
		Route::patch(   'actualizar/{id}',  ['as' => 'levels.update',   'uses' => 'LevelController@update']);
		Route::delete(  '{id}',             ['as' => 'levels.delete',   'uses' => 'LevelController@destroy']);

		// -------------- API's --------------------
		Route::get('api/lista', ['as' => 'levels.api.list', 'uses' => 'LevelController@apiList']);
	});

	Route::group(['prefix' => 'pluranza', 'namespace' => 'Pluranza'], function () {

		/*
	* ---------- Academies ----------
	*/
		Route::group(['prefix' => 'academias'], function () {
			Route::delete('{id}', ['as' => 'pluranza.academies.delete', 'uses' => 'Academy@destroy']);
		});
		/*
		* ---------- Comptition Types ----------
		 */
		Route::group(['prefix' => 'tipos-de-competicion'], function () {
			Route::get('/', ['as' => 'pluranza.competition-types.home', 'uses' => 'CompetitionTypeController@index']);
			Route::get('nueva', ['as' => 'pluranza.competition-types.new', 'uses' => 'CompetitionTypeController@create']);
			Route::post('/', ['as' => 'pluranza.competition-types.store', 'uses' => 'CompetitionTypeController@store']);
			Route::get('ver/{id}', ['as' => 'pluranza.competition-types.show', 'uses' => 'CompetitionTypeController@show']);
			Route::get('editar/{id}', ['as' => 'pluranza.competition-types.edit', 'uses' => 'CompetitionTypeController@edit']);
			Route::patch('actualizar/{id}', ['as' => 'pluranza.competition-types.update', 'uses' => 'CompetitionTypeController@update']);
			Route::delete('{id}', ['as' => 'pluranza.competition-types.delete', 'uses' => 'CompetitionTypeController@destroy']);

			// -------------- API's --------------------
			Route::get('api/lista', ['as' => 'pluranza.competition-types.api.list', 'uses' => 'CompetitionTypeController@apiList']);
		});

		/*
		* ---------- Comptition Category ----------
		 */
		Route::group(['prefix' => 'categorias-en-competencia'], function () {
			Route::get('/', ['as' => 'pluranza.competition-categories.home', 'uses' => 'CompetitionCategoryController@index']);
			Route::get('nueva', ['as' => 'pluranza.competition-categories.new', 'uses' => 'CompetitionCategoryController@create']);
			Route::post('/', ['as' => 'pluranza.competition-categories.store', 'uses' => 'CompetitionCategoryController@store']);
			Route::get('ver/{id}', ['as' => 'pluranza.competition-categories.show', 'uses' => 'CompetitionCategoryController@show']);
			Route::get('editar/{id}', ['as' => 'pluranza.competition-categories.edit', 'uses' => 'CompetitionCategoryController@edit']);
			Route::patch('actualizar/{id}', ['as' => 'pluranza.competition-categories.update', 'uses' => 'CompetitionCategoryController@update']);
			Route::delete('{id}', ['as' => 'pluranza.competition-categories.delete', 'uses' => 'CompetitionCategoryController@destroy']);

			// -------------- API's --------------------
			Route::get('api/lista', ['as' => 'pluranza.competition-categories.api.list', 'uses' => 'CompetitionCategoryController@apiList']);
			Route::get('api/lista/por-categoria/{id}', ['as' => 'pluranza.competition-categories.api.by-category', 'uses' => 'CompetitionCategoryController@apiByCategoryList']);
			Route::get('api/lista/por-nivel/{id}', ['as' => 'pluranza.competition-categories.api.by-level', 'uses' => 'CompetitionCategoryController@apiByLevelList']);

		});
	});
});

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

	Route::post('academias', ['middleware' => ['guest', 'role:admin'], 'as' => 'pluranza.academies.store', 'uses' => 'AcademyController@store']);

	/*
	* ---------- Academies ----------
	*/
	Route::group(['prefix' => 'academias'], function () {

		Route::get('/', ['as' => 'pluranza.academies.home', 'uses' => 'AcademyController@index']);

		Route::get('editar/{id}', ['middleware' => ['role:admin|director'], 'as' => 'pluranza.academies.edit', 'uses' => 'AcademyController@edit']);

		Route::patch('actualizar/{id}', ['middleware' => ['role:admin|director'], 'as' => 'pluranza.academies.update', 'uses' => 'AcademyController@update']);
	});

	/*
	* ---------- Dancers ----------
	*/
	Route::group(['prefix' => 'bailarines'], function () {

		Route::get('ver/{id}', ['as' => 'pluranza.dancers.show', 'uses' => 'DancerController@show']);
		Route::get('/', ['as' => 'pluranza.dancers.home', 'uses' => 'DancerController@index']);
		Route::get('api/lista', ['as' => 'pluranza.dancers.api.list', 'uses' => 'DancerController@apiList']);
		Route::get('{id}', ['as' => 'pluranza.dancers.by-academy', 'uses' => 'DancerController@byAcademy']);
		Route::get('api/lista/{id}', ['as' => 'pluranza.dancers.api.by-academy', 'uses' => 'DancerController@apiByAcademyList']);

		Route::group(['prefix' => 'bailarines', 'middleware' => ['role:admin|director']], function () {
			Route::get('nuevo/{id}', ['as' => 'pluranza.dancers.new', 'uses' => 'DancerController@create']);
			Route::post('/', ['as' => 'pluranza.dancers.store', 'uses' => 'DancerController@store']);
			Route::get('editar/{id}', ['as' => 'pluranza.dancers.edit', 'uses' => 'DancerController@edit']);
			Route::patch('actualizar/{id}', ['as' => 'pluranza.dancers.update', 'uses' => 'DancerController@update']);
			Route::delete('{id}', ['as' => 'pluranza.dancers.delete', 'uses' => 'DancerController@destroy']);
		});
	});

	/*
	* ---------- Competitor ----------
    */
	Route::group(['prefix' => 'competidores'], function () {
		Route::get('ver/{id}', ['as' => 'pluranza.competitors.show', 'uses' => 'CompetitorController@show']);
		Route::get('/', ['as' => 'pluranza.competitors.home', 'uses' => 'CompetitorController@index']);
		Route::get('{id}', ['as' => 'pluranza.competitors.by-academy', 'uses' => 'CompetitorController@byAcademy']);
		// -------------- API's --------------------
		Route::get('api/lista', ['as' => 'pluranza.competitors.api.list', 'uses' => 'CompetitorController@apiList']);
		Route::get('api/lista/{id}', ['as' => 'pluranza.competitors.api.by-academy', 'uses' => 'CompetitorController@apiByAcademyList']);

		Route::group(['prefix' => 'bailarines', 'middleware' => ['role:admin|director']], function () {
			Route::get('nueva/{id}', ['as' => 'pluranza.competitors.new', 'uses' => 'CompetitorController@create']);
			Route::post('/', ['as' => 'pluranza.competitors.store', 'uses' => 'CompetitorController@store']);
			Route::get('editar/{id}', ['as' => 'pluranza.competitors.edit', 'uses' => 'CompetitorController@edit']);
			Route::patch('actualizar/{id}', ['as' => 'pluranza.competitors.update', 'uses' => 'CompetitorController@update']);
			Route::delete('{id}', ['as' => 'pluranza.competitors.delete', 'uses' => 'CompetitorController@destroy']);
		});
	});

	/*
	* ---------- Pagos ----------
    */
	Route::group(['prefix' => 'pagos'], function () {

		Route::group(['prefix' => 'bailarines', 'middleware' => ['role:admin']], function () {
			Route::get('/', ['as' => 'pluranza.payments.home', 'uses' => 'PaymentController@index']);
			Route::get('confirmar/{id}', ['as' => 'pluranza.payments.confirm', 'uses' => 'PaymentController@confirm']);
			Route::get('rechazar/{id}', ['as' => 'pluranza.payments.refuse', 'uses' => 'PaymentController@refuse']);
			// -------------- API's --------------------
			Route::get('api/lista', ['as' => 'pluranza.payments.api.list', 'uses' => 'PaymentController@apiList']);
		});

		Route::group(['prefix' => 'bailarines', 'middleware' => ['role:admin|director']], function () {
			Route::get('{id}', ['as' => 'pluranza.payments.by-academy', 'uses' => 'PaymentController@byAcademy']);
			Route::get('pagar/{id}', ['as' => 'pluranza.payments.new', 'uses' => 'PaymentController@create']);
			Route::post('/', ['as' => 'pluranza.payments.store', 'uses' => 'PaymentController@store']);
			Route::get('ver/{id}', ['as' => 'pluranza.payments.show', 'uses' => 'PaymentController@show']);
			Route::get('editar/{id}', ['as' => 'pluranza.payments.edit', 'uses' => 'PaymentController@edit']);
			Route::patch('actualizar/{id}', ['as' => 'pluranza.payments.update', 'uses' => 'PaymentController@update']);
			Route::delete('{id}', ['as' => 'pluranza.payments.delete', 'uses' => 'PaymentController@destroy']);
			// -------------- API's --------------------
			Route::get('api/lista/{id}', ['as' => 'pluranza.payments.api.by-academy', 'uses' => 'PaymentController@apiByAcademyList']);
		});
	});
});