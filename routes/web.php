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

Route::get('/result', 'resultController@index')
	->name('resultados');

Route::get('/newRes','ResidenciasController@ResForm')
	->name('crearResidencia');

Route::post('/newResLoc','ResidenciasController@ResForm')
	->name('continuar');

Route::post('/newRes','ResidenciasController@store')
	->name('altaExitosa');

Route::get('/newSub','SubastaController@SubForm')
	->name('crearSubasta');

Route::get('/lisSub','resultController@listarSubasta')
	->name('listarSubasta');

Route::post('/newSub','SubastaController@store')
	->name('subAltaExitosa');

Route::get('/subastas/{id}','SubastaController@EditSub')
	->name('editSub');

Route::put('/subastas/{id}','SubastaController@update')
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

Route::get('/upload/{id}','ResidenciasController@UploadFoto')
	->name('upload');

Route::post('/upload/{id}','ResidenciasController@fotoExitosa')
	->name('fotoexitosa');

Route::put('/residencias/edit/{residencia}','ResidenciasController@update')
	->name('updateExitoso');

Route::get('/lisRes','ResidenciasController@ResList')
	->name('listarResidencias');

Route::delete('/residencias/{residencia}','ResidenciasController@destroy')
	->name('aniquilarResidencia');

Route::get('/ubicacion/alta', 'UbicacionController@UbicacionForm')
	->name('altaUbicacion');

Route::post('/ubicacion/alta', 'UbicacionController@store')
	->name('altaUbicacion');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get_captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {return $captcha->src($config);
});
