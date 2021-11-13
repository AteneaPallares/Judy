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
    return view('welcome');
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