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
	return route('pluranza.academies.resend-confirm');
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
	return response()->json(\App\Estate::all()->lists('name', 'id'));
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
Route::group(['prefix' => 'usuarios'], function () {
	Route::get('login', ['as' => 'users.login', 'uses' => 'SessionController@login']);

	Route::post('api/login', ['as' => 'users.api.login', 'uses' => 'SessionController@postApiLogin']);

	Route::post('login', ['as' => 'users.login', 'uses' => 'Auth\AuthController@postLogin'/*'SessionController@postLogin'*/]);

	Route::get('logout', ['middleware' => 'auth', 'as' => 'users.logout', 'uses' => 'SessionController@logout']);

	Route::get('confirmar/{token}', ['as' => 'users.confirm', 'uses' => 'SessionController@confirm']);

	Route::get('password/email', ['as' => 'users.password.reset', 'uses' => 'Auth\PasswordController@getEmail']);
	Route::post('password/email', ['as' => 'users.password.send-reset', 'uses' => 'Auth\PasswordController@postEmail']);

// Password reset routes...
	Route::get('password/reset/{token}', ['as' => 'users.password.reset-token', 'uses' => 'Auth\PasswordController@getReset']);
	Route::post('password/reset', ['as' => 'users.password.reset-check-token', 'uses' => 'Auth\PasswordController@postReset']);
});

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

	/*
	* ---------- Configuration ----------
	*/
	Route::group(['prefix' => 'configurations'], function () {
		Route::get('/', ['as' => 'configurations.home', 'uses' => 'ConfigurationController@index']);
		Route::get('nueva', ['as' => 'configurations.new', 'uses' => 'ConfigurationController@create']);
		Route::post('/', ['as' => 'configurations.store', 'uses' => 'ConfigurationController@store']);
		Route::get('ver/{id}', ['as' => 'configurations.show', 'uses' => 'ConfigurationController@show']);
		Route::get('editar/{id}', ['as' => 'configurations.edit', 'uses' => 'ConfigurationController@edit']);
		Route::patch('actualizar/{id}', ['as' => 'configurations.update', 'uses' => 'ConfigurationController@update']);
		Route::delete('{id}', ['as' => 'configurations.delete', 'uses' => 'ConfigurationController@destroy']);

		// -------------- API's --------------------
		Route::get('api/lista', ['as' => 'configurations.api.list', 'uses' => 'ConfigurationController@apiList']);
	});

	Route::group(['prefix' => 'pluranza', 'namespace' => 'Pluranza'], function () {


		/*
		* ---------- Academies ----------
		*/
		Route::group(['prefix' => 'academias'], function () {
			Route::delete('{id}', ['as' => 'pluranza.academies.delete', 'uses' => 'Academy@destroy']);
			Route::get('/resent-confirm', ['as' => 'pluranza.academies.resend-confirm', 'uses' => 'AcademyController@resendToNoVerifiedAccounts']);
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

	/*
	* ---------- Academies ----------
	*/
	Route::group(['prefix' => 'academias'], function () {
		Route::get('/', ['as' => 'pluranza.academies.home', 'uses' => 'AcademyController@index']);
		Route::get('nuevo', ['as' => 'pluranza.academies.new', 'uses' => 'AcademyController@create']);
		Route::post('/', ['as' => 'pluranza.academies.store', 'uses' => 'AcademyController@store']);
		Route::get('ver/{id}', ['as' => 'pluranza.academies.show', 'uses' => 'AcademyController@show']);
		Route::group(['middleware' => ['ownAcademy']], function () {
			Route::get('editar/{id}', ['middleware' => ['role:admin|director'], 'as' => 'pluranza.academies.edit', 'uses' => 'AcademyController@edit']);
			Route::patch('actualizar/{id}', ['middleware' => ['role:admin|director'], 'as' => 'pluranza.academies.update', 'uses' => 'AcademyController@update']);
			Route::delete('{id}', ['middleware' => ['role:admin'], 'as' => 'pluranza.academies.delete', 'uses' => 'AcademyController@destroy']);
		});
		// -------------- API's --------------------
		Route::get('api/lista', ['as' => 'pluranza.academies.api.list', 'uses' => 'AcademyController@apiList']);
	});

	/*
		* ---------- Comptition Category ----------
		 */
	Route::group(['prefix' => 'categorias-en-competencia', 'middleware' => ['role:admin|director']], function () {
		// -------------- API's --------------------
		// -------------- API's --------------------
		Route::get('api/lista', ['as' => 'pluranza.competition-categories.api.list', 'uses' => 'CompetitionCategoryController@apiList']);
		Route::get('api/lista/por-categoria-tipo-competencia/{categoryId}/{competitionTypeId}', ['as' => 'pluranza.competition-categories.api.by-category-competition-type', 'uses' => 'CompetitionCategoryController@apiByCategoryListCompetitionType']);
		Route::get('api/lista/por-nivel/{id}', ['as' => 'pluranza.competition-categories.api.by-level', 'uses' => 'CompetitionCategoryController@apiByLevelList']);
	});

	/*
	* ---------- Dancers ----------
	*/
	Route::group(['prefix' => 'bailarines'], function () {

		Route::get('ver/{id}', ['as' => 'pluranza.dancers.show', 'uses' => 'DancerController@show']);
		Route::get('/', ['as' => 'pluranza.dancers.home', 'uses' => 'DancerController@index']);
		Route::get('por-academia/{id}', ['as' => 'pluranza.dancers.by-academy', 'uses' => 'DancerController@byAcademy']);

		// -------------- API's --------------------
		Route::get('api/lista', ['as' => 'pluranza.dancers.api.list', 'uses' => 'DancerController@apiList']);
		Route::get('api/lista/por-academia/{id}', ['as' => 'pluranza.dancers.api.by-academy', 'uses' => 'DancerController@apiByAcademyList']);

		Route::group(['middleware' => ['role:admin|director']], function () {
			Route::get('nuevo/{id}', ['middleware' => ['role:admin'], 'as' => 'pluranza.dancers.new', 'uses' => 'DancerController@create']);
			Route::get('por-academia/nuevo/{id}', ['as' => 'pluranza.dancers.new.by-academy', 'uses' => 'DancerController@createByAcademy']);
			Route::post('/', ['as' => 'pluranza.dancers.store', 'uses' => 'DancerController@store']);
			Route::group(['middleware' => ['ownDancer']], function () {
				Route::get('editar/{id}', ['as' => 'pluranza.dancers.edit', 'uses' => 'DancerController@edit']);
				Route::patch('actualizar/{id}', ['as' => 'pluranza.dancers.update', 'uses' => 'DancerController@update']);
				Route::delete('{id}', ['as' => 'pluranza.dancers.delete', 'uses' => 'DancerController@destroy']);
			});
		});
	});

	/*
	* ---------- Competitor ----------
    */
	Route::group(['prefix' => 'competidores'], function () {
		Route::get('ver/{id}', ['as' => 'pluranza.competitors.show', 'uses' => 'CompetitorController@show']);
		Route::get('/', ['as' => 'pluranza.competitors.home', 'uses' => 'CompetitorController@index']);
		Route::get('por-academia/{id}', ['as' => 'pluranza.competitors.by-academy', 'uses' => 'CompetitorController@byAcademy']);

		// -------------- API's --------------------
		Route::get('api/lista', ['as' => 'pluranza.competitors.api.list', 'uses' => 'CompetitorController@apiList']);
		Route::get('api/lista/por-academia/{id}', ['as' => 'pluranza.competitors.api.by-academy', 'uses' => 'CompetitorController@apiByAcademyList']);

		Route::group(['middleware' => ['role:admin|director']], function () {
			Route::get('nueva/', ['middleware' => ['role:admin'], 'as' => 'pluranza.competitors.new', 'uses' => 'CompetitorController@create']);
			Route::get('por-academia/nueva/{id}', ['as' => 'pluranza.competitors.new.by-academy', 'uses' => 'CompetitorController@createByAcademy']);
			Route::post('/', ['as' => 'pluranza.competitors.store', 'uses' => 'CompetitorController@store']);
			Route::group(['middleware' => ['ownCompetitor']], function () {
				Route::get('editar/{id}', ['as' => 'pluranza.competitors.edit', 'uses' => 'CompetitorController@edit']);
				Route::patch('actualizar/{id}', ['as' => 'pluranza.competitors.update', 'uses' => 'CompetitorController@update']);
				Route::delete('{id}', ['as' => 'pluranza.competitors.delete', 'uses' => 'CompetitorController@destroy']);
			});
		});
	});

	/*
	* ---------- Pagos ----------
    */
	Route::group(['prefix' => 'pagos'], function () {

		Route::group(['middleware' => ['role:admin']], function () {
			Route::get('/', ['as' => 'pluranza.payments.home', 'uses' => 'PaymentController@index']);
			Route::get('confirmar/{id}', ['as' => 'pluranza.payments.confirm', 'uses' => 'PaymentController@confirm']);
			Route::get('rechazar/{id}', ['as' => 'pluranza.payments.refuse', 'uses' => 'PaymentController@refuse']);
			// -------------- API's --------------------
			Route::get('api/lista', ['as' => 'pluranza.payments.api.list', 'uses' => 'PaymentController@apiList']);
		});

		Route::group(['middleware' => ['role:admin|director', 'ownPayment']], function () {
			Route::get('por-academia/{id}', ['as' => 'pluranza.payments.by-academy', 'uses' => 'PaymentController@byAcademy']);
			Route::get('pagar/{id}', ['as' => 'pluranza.payments.new', 'uses' => 'PaymentController@create']);
			Route::post('/', ['as' => 'pluranza.payments.store', 'uses' => 'PaymentController@store']);
			Route::get('ver/{id}', ['as' => 'pluranza.payments.show', 'uses' => 'PaymentController@show']);
			Route::get('editar/{id}', ['as' => 'pluranza.payments.edit', 'uses' => 'PaymentController@edit']);
			Route::patch('actualizar/{id}', ['as' => 'pluranza.payments.update', 'uses' => 'PaymentController@update']);
			Route::delete('{id}', ['as' => 'pluranza.payments.delete', 'uses' => 'PaymentController@destroy']);
			// -------------- API's --------------------
			Route::get('api/lista/por-academia/{id}', ['as' => 'pluranza.payments.api.by-academy', 'uses' => 'PaymentController@apiByAcademyList']);
		});
	});
});