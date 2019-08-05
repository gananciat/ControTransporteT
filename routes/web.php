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