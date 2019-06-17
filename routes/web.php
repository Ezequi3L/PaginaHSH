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

Route::get('/', 'WelcomeController@index')
	->name('inicio');

Auth::routes();

Route::group( ['middleware' => 'auth' ], function() {  // rutas para las cuales hay que estar logueado

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/result', 'resultController@index')
		->name('resultados');

	Route::get('/newRes','ResidenciasController@ResForm')
		->name('crearResidencia');

	Route::post('/newRes','ResidenciasController@store')
		->name('altaExitosa');

	Route::get('/newSub/{id}','SubastaController@SubForm')
		->name('crearSubasta');

	Route::get('/lisSub','resultController@listarSubasta')
		->name('listarSubasta');

	Route::post('/newSub','SubastaController@store')
		->name('subAltaExitosa');

	Route::get('/subastas/{id}','SubastaController@EditSub')
		->name('editSub');

	Route::put('/subasta/{id}','SubastaController@update')
		->name('subUpdateExitoso');

	Route::get('/subastas/adjudicar/{id}','SubastaController@Adjudicar')
		->name('adjudicar');

	Route::post('/subastas/adjudicar/{id}','SubastaController@GuardarAdjudicacion')
		->name('saveAdj');

	Route::delete('/subastas/{subasta}','SubastaController@destroy')
		->name('deleteSub');

	Route::get('/ofertaSub/{subasta}','OfertaController@OfertaForm')
		->name('ofertar');

	Route::post('/ofertaSub','OfertaController@store')
		->name('subOfertaExitosa');

	Route::get('/residencias/{id}','ResidenciasController@ViewRes')
		->name('viewRes');

	Route::get('/residencias/edit/{id}','ResidenciasController@EditRes')
		->name('editRes');

	Route::put('/residencias/edit/{residencia}','ResidenciasController@update')
		->name('updateExitoso');

	Route::get('/upload/{id}','FotosController@UploadFoto')
		->name('upload');

	Route::post('/upload/{id}','FotosController@fotoExitosa')
		->name('fotoexitosa');

	Route::get('/bajaFoto/{id}', 'FotosController@BajaFoto')
		->name('BajaFoto');

	Route::delete('/bajaFoto/{id}','FotosController@destroy')
		->name('BajaFotoOk');

	Route::get('/lisRes','ResidenciasController@ResList')
		->name('listarResidencias');

	Route::delete('/residencias/{residencia}','ResidenciasController@destroy')
		->name('aniquilarResidencia');

	Route::get('/ubicacion/alta', 'UbicacionController@UbicacionForm')
		->name('altaUbicacion');

	Route::post('/ubicacion/alta', 'UbicacionController@store')
		->name('altaUbicacion');

	Route::get('/usuarios/list','UserController@listado')
		->name('listUsr');

	Route::post('/usuario/verificar/{id}','UserController@check')
		->name('check');

	Route::get('/usuarios/{id}','UserController@ViewUsr')
		->name('viewUsr');

	Route::get('/usuarios/edit/{id}','UserController@EditUsr')
		->name('editUsr');

	Route::put('/usuarios/edit/{user}','UserController@update')
		->name('usrUpdateExitoso');

	Route::get('/usuarios/pass/{user}','UserController@ChangePass')
		->name('changePass');

	Route::put('/usuarios/pass/{user}','UserController@updatePass')
		->name('updatePass');
});

Route::get('/get_captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {return $captcha->src($config);
});
