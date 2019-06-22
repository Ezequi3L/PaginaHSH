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

Route::get('/sucursales', 'WelcomeController@sucursales')
	->name('sucursales');

Auth::routes();

Route::group( ['middleware' => 'auth' ], function() {  // rutas para las cuales hay que estar logueado

	Route::group( ['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {  // rutas solo para admins

		Route::get('/newRes','ResidenciasController@ResForm')
			->name('crearResidencia');

		Route::post('/newRes','ResidenciasController@store')
			->name('altaExitosa');

		Route::get('/newSub/{id}','SubastaController@SubForm')
			->name('crearSubasta');

		Route::post('/newSub','SubastaController@store')
			->name('subAltaExitosa');

		Route::get('/newHS/{id}','HotSaleController@HSForm')
			->name('crearHotSale');

		Route::post('/newHS','HotSaleController@store')
			->name('hotsaleAltaExitosa');

		Route::get('/subastas/{id}','SubastaController@EditSub')
			->name('editSub');

		Route::get('/hotsales/{id}','HotSaleController@EditHS')
			->name('editHS');

		Route::put('/subasta/{id}','SubastaController@update')
			->name('subUpdateExitoso');

		Route::put('/hotsale/{id}','HotSaleController@update')
			->name('hsUpdateExitoso');

		Route::get('/subastas/adjudicar/{id}','SubastaController@Adjudicar')
			->name('adjudicar');

		Route::post('/subastas/adjudicar/{id}','SubastaController@GuardarAdjudicacion')
			->name('saveAdj');

		Route::delete('/subastas/{subasta}','SubastaController@destroy')
			->name('deleteSub');

		Route::delete('/hotsales/{hotsale}','HotSaleController@destroy')
			->name('deleteHS');

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

		Route::delete('/residencias/{residencia}','ResidenciasController@destroy')
			->name('aniquilarResidencia');

		Route::post('/residencias/rehab/{residencia}','ResidenciasController@habilitarResidencia')
			->name('habilitarResidencia');

		Route::get('/ubicacion/alta', 'UbicacionController@UbicacionForm')
			->name('altaUbicacion');

		Route::post('/ubicacion/alta', 'UbicacionController@store')
			->name('altaUbicacion');

		Route::get('/usuarios/list','UserController@listado')
			->name('listUsr');

		Route::post('/usuario/verificar/{id}','UserController@check')
			->name('check');

		Route::get('/usuarios/upglist','UserController@listadoupg')
			->name('listUpgUsr');

		Route::post('/usuario/upgradear/{id}','UserController@upgrade')
			->name('upgrade');

		Route::get('/enviar/{destinatario}','MailController@sendMail')
			->name('sendMail');

		Route::get('/enviarSubElim/{destinatarios}','MailController@subElim')
			->name('sendMailSubElim');

		Route::delete('/usuarios/altf4/{id}','UserController@destroy')
			->name('deleteUsr');

		Route::post('/usuarios/rehab/{usr}','UserController@habilitarUsr')
			->name('habilitarUsr');

});

	Route::group( ['middleware' => 'App\Http\Middleware\UserOrAdminMiddleware'], function() { // Un usuario solo puede
																							  // verse/modificarse
		Route::get('/usuarios/{id}','UserController@ViewUsr')								  // a sí mismo.
			->name('viewUsr');

		Route::get('/usuarios/edit/{id}','UserController@EditUsr')
			->name('editUsr');

	});

	Route::put('/usuarios/edit/{user}','UserController@update') // no importa porque no es GET
			->name('usrUpdateExitoso');

	Route::group( ['middleware' => 'App\Http\Middleware\UserMiddleware'], function() { // un admin no puede modificar la contraseña 																				   //de un usuario
		Route::get('/usuarios/pass/{user}','UserController@ChangePass')
			->name('changePass');

		Route::put('/usuarios/pass/{user}','UserController@updatePass')
			->name('updatePass');

	});

	Route::get('/home', 'HomeController@index')
		->name('home');

	Route::get('/result', 'resultController@index')
		->name('resultados');

	Route::get('/lisSub','resultController@listarSubasta')
		->name('listarSubasta');

	Route::get('/lisHS','resultController@listarHotSale')
		->name('listarHotSale');

	Route::get('/lisRes','ResidenciasController@ResList')
		->name('listarResidencias');

	Route::get('/residencias/{id}','ResidenciasController@ViewRes')
		->name('viewRes');

	Route::group( ['middleware' => 'App\Http\Middleware\ClientMiddleware'], function() {  //	solo para clientes

		Route::get('/ofertaSub/{subasta}','OfertaController@OfertaForm')
			->name('ofertar');

		Route::post('/ofertaSub','OfertaController@store')
		->name('subOfertaExitosa');

		Route::get('/compraHS/{hotsale}','HotSaleController@CompraHS')
		->name('comprarHS');

		Route::get('/reservasList/{id}','ReservaController@listarReservas')
			->name('listaReservasDeUsuario');

		Route::delete('/reservas/{reserva}','ReservaController@cancelarReserva')
			->name('deleteReserva');

		Route::post('/solicitarUpg/{user}','UserController@solUpgrade')
			->name('solUpgrade');

	});

	Route::group( ['middleware' => 'App\Http\Middleware\PremiumMiddleware'], function() {  //	solo para premium

		Route::post('/newReserva','ReservaController@store')
			->name('reservaExitosa');

	});

});

Route::get('/get_captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {return $captcha->src($config);
});
