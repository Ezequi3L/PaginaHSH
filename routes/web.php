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

Route::post('/result', 'resultController@index')
	->name('resultados');

Route::get('/newRes','ResidenciasController@ResForm')
	->name('crearResidencia');

Route::post('/newResLoc','ResidenciasController@ResForm')
	->name('continuar');

Route::post('/newRes','ResidenciasController@store')
	->name('altaExitosa');

Route::get('/newSub','SubastaController@SubForm')
	->name('crearSubasta');

Route::post('/newSub','SubastaController@store')
	->name('subAltaExitosa');

Route::get('/ofertaSub/{subasta}','OfertaController@OfertaForm')
	->name('ofertar');

Route::post('/ofertaSub','OfertaController@store')
	->name('subOfertaExitosa');