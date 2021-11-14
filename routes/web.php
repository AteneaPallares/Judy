<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('catalogue');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/empleados','App\Http\Controllers\UserController@index')->name('users.index');
Route::get('/empleados/all','App\Http\Controllers\UserController@showall')->name('users.showall');
Route::get('/empleados/editar/{id}','App\Http\Controllers\UserController@showedit')->name('users.edit');
Route::get('/empleados/detalleone/{id}','App\Http\Controllers\UserController@showone')->name('users.nuevo');
Route::get('/empleados/agregar','App\Http\Controllers\UserController@create')->name('users.create');
Route::get('/empleados/detalle/{id}','App\Http\Controllers\UserController@show')->name('users.show');
Route::get('/empleados/actual','App\Http\Controllers\UserController@actual')->name('users.show');
Route::delete('/empleados/{id}', 'App\Http\Controllers\UserController@destroy');
Route::apiResource('empleados', 'App\Http\Controllers\UserController');

Route::apiResource('roles', 'App\Http\Controllers\RoleController');

Route::get('/clientes','App\Http\Controllers\ClientController@index')->name('clientes.index');
Route::get('/clientes/all','App\Http\Controllers\ClientController@showall')->name('clientes.showall');
Route::get('/clientes/editar/{id}','App\Http\Controllers\ClientController@showedit')->name('clientes.edit');
Route::get('/clientes/detalleone/{id}','App\Http\Controllers\ClientController@showone')->name('clientes.nuevo');
Route::get('/clientes/agregar','App\Http\Controllers\ClientController@create')->name('clientes.create');
Route::get('/clientes/detalle/{id}','App\Http\Controllers\ClientController@show')->name('clientes.show');
Route::apiResource('clientes', 'App\Http\Controllers\ClientController');

Route::get('/productos','App\Http\Controllers\ProductController@index')->name('productos.index');
Route::get('/productos/all','App\Http\Controllers\ProductController@showall')->name('productos.showall');
Route::get('/productos/editar/{id}','App\Http\Controllers\ProductController@showedit')->name('productos.edit');
Route::get('/productos/detalleone/{id}','App\Http\Controllers\ProductController@showone')->name('productos.nuevo');
Route::get('/productos/agregar','App\Http\Controllers\ProductController@create')->name('productos.create');
Route::get('/productos/detalle/{id}','App\Http\Controllers\ProductController@show')->name('productos.show');
Route::apiResource('productos', 'App\Http\Controllers\ProductController');

Route::get('/proveedores','App\Http\Controllers\SupplierController@index')->name('proveedores.index');
Route::get('/proveedores/all','App\Http\Controllers\SupplierController@showall')->name('proveedores.showall');
Route::get('/proveedores/editar/{id}','App\Http\Controllers\SupplierController@showedit')->name('proveedores.edit');
Route::get('/proveedores/detalleone/{id}','App\Http\Controllers\SupplierController@showone')->name('proveedores.nuevo');
Route::get('/proveedores/agregar','App\Http\Controllers\SupplierController@create')->name('proveedores.create');
Route::get('/proveedores/detalle/{id}','App\Http\Controllers\SupplierController@show')->name('proveedores.show');
Route::apiResource('proveedores', 'App\Http\Controllers\SupplierController');

Route::get('/iva','App\Http\Controllers\IvaController@index')->name('iva.index');
Route::get('/iva/all','App\Http\Controllers\IvaController@showall')->name('iva.showall');
Route::get('/iva/editar/{id}','App\Http\Controllers\IvaController@showedit')->name('iva.edit');
Route::get('/iva/detalleone/{id}','App\Http\Controllers\IvaController@showone')->name('iva.nuevo');
Route::get('/iva/agregar','App\Http\Controllers\IvaController@create')->name('iva.create');
Route::get('/iva/detalle/{id}','App\Http\Controllers\IvaController@show')->name('iva.show');
Route::apiResource('iva', 'App\Http\Controllers\IvaController');