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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/grafica/lineas', 'HomeController@lineas')->name('lineas');
Route::get('/grafica/rutas', 'HomeController@rutas')->name('rutas');
Route::get('/grafica/primer_tipo_pago', 'HomeController@primer_tipo_pago')->name('primer_tipo_pago');
Route::get('/grafica/segundo_tipo_pago', 'HomeController@segundo_tipo_pago')->name('segundo_tipo_pago');
Route::get('/grafica/pagos', 'HomeController@pagos')->name('pagos');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('tipoPersonasView', 'TipoPersona\TipoPersonaController@view')->name('tipoPersonasView');
Route::resource('tipoPersonas', 'TipoPersona\TipoPersonaController', ['except' => ['create', 'edit']]);

Route::get('tipoUsuariosView', 'TipoUsuario\TipoUsuarioController@view')->name('tipoUsuariosView');
Route::resource('tipoUsuarios', 'TipoUsuario\TipoUsuarioController', ['except' => ['create', 'edit']]);

Route::get('conceptoPagosView', 'ConceptoPago\ConceptoPagoController@view')->name('conceptoPagosView');
Route::resource('conceptoPagos', 'ConceptoPago\ConceptoPagoController', ['except' => ['create', 'edit']]);

Route::get('ubicacionesView', 'Ubicacion\ubicacionController@view')->name('ubicacionesView');
Route::resource('ubicacions', 'Ubicacion\UbicacionController', ['except' => ['create', 'edit']]);

Route::get('destinosView', 'Destino\DestinoController@view')->name('destinosView');
Route::resource('destinos', 'Destino\DestinoController', ['except' => ['create', 'edit']]);

Route::get('aniosView', 'Anio\AnioController@view')->name('aniosView');
Route::resource('anios', 'Anio\AnioController', ['except' => ['create', 'edit']]);

Route::get('cargosView', 'Cargo\CargoController@view')->name('cargosView');
Route::resource('cargos', 'Cargo\CargoController', ['except' => ['create', 'edit']]);

Route::resource('mess', 'Mes\MesController', ['except' => ['create', 'edit']]);

Route::get('personasView', 'Persona\PersonaController@view')->name('personasView');
Route::resource('personas', 'Persona\PersonaController', ['except' => ['create', 'edit']]);
Route::resource('personas.expedientes', 'Persona\PersonaExpedienteController', ['except' => ['create', 'edit']]);
Route::resource('personas.lineas', 'Persona\PropietarioLineaController', ['except' => ['create', 'edit']]);
Route::resource('personas.pagos', 'Persona\PropietarioPagoController', ['except' => ['create', 'edit']]);

Route::resource('expedientes', 'Expediente\ExpedienteController', ['except' => ['create', 'edit']]);

Route::get('rutasView', 'Ruta\RutaController@view')->name('rutasView');
Route::resource('rutas', 'Ruta\RutaController', ['except' => ['create', 'edit']]);

Route::get('tipoTransportesView', 'TipoTransporte\TipoTransporteController@view')->name('tipoTransportesView');
Route::resource('tipoTransportes', 'TipoTransporte\TipoTransporteController', ['except' => ['create', 'edit']]);

Route::get('marcaTransportesView', 'MarcaTransporte\MarcaTransporteController@view')->name('marcaTransportesView');
Route::resource('marcaTransportes', 'MarcaTransporte\MarcaTransporteController', ['except' => ['create', 'edit']]);

Route::get('lineasView', 'Linea\LineaController@view')->name('lineasView');
Route::resource('lineas', 'Linea\LineaController', ['except' => ['create', 'edit']]);
Route::resource('lineas.propietarios', 'Linea\LineaPropietarioLineaController', ['except' => ['create', 'edit']]);
Route::resource('lineas.chofers', 'Linea\LineaLineaChoferController', ['except' => ['create', 'edit']]);

Route::resource('propietarioLineas', 'Linea\PropietarioLineaController', ['except' => ['create', 'edit']]);

Route::resource('lineaChofers', 'Linea\LineaChoferController', ['except' => ['create', 'edit']]);

Route::get('transportesView', 'Transporte\TransporteController@view')->name('transportesView');
Route::resource('transportes', 'Transporte\TransporteController', ['except' => ['create', 'edit']]);

Route::get('montoMultasView', 'MontoMulta\MontoMultaController@view')->name('montoMultasView');
Route::resource('montoMultas', 'MontoMulta\MontoMultaController', ['except' => ['create', 'edit']]);

Route::get('tipoMultasView', 'TipoMulta\TipoMultaController@view')->name('tipoMultasView');
Route::resource('tipoMultas', 'tipoMulta\tipoMultaController', ['except' => ['create', 'edit']]);

Route::get('causasView', 'Causa\CausaController@view')->name('causasView');
Route::resource('causas', 'Causa\CausaController', ['except' => ['create', 'edit']]);

Route::get('multasView', 'Multa\MultaController@view')->name('multasView');
Route::get('pagoMultasView', 'Multa\MultaController@viewPagos')->name('pagoMultasView');
Route::resource('multas', 'Multa\MultaController', ['except' => ['create', 'edit']]);
Route::put('multas_revertir/{id}', 'Multa\MultaController@revertir')->name('multas_revertir');

Route::get('pagosView', 'Pago\PagoController@view')->name('pagosView');
Route::resource('pagos', 'Pago\PagoController', ['except' => ['create', 'edit']]);
Route::put('pagos_anular/{id}', 'Pago\PagoController@anular')->name('pagos_anular');

Route::get('inspeccionesView', 'Inspeccion\InspeccionController@view')->name('inspeccionesView');
Route::resource('inspeccions', 'Inspeccion\InspeccionController', ['except' => ['create', 'edit']]);

Route::get('usersView', 'User\userController@view')->name('usersView');
Route::resource('users', 'User\userController', ['except' => ['create', 'edit']]);

Route::get('cambiarContrasenaView', 'User\userController@viewCambiarContraseña')->name('cambiarContrasenaView');
Route::name('cambiar_contraseña')->post('users_change_password','User\UserController@changePassword');