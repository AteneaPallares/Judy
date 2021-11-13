Route::get('/clientes','App\Http\Controllers\ClientController@index')->name('clientes.index');
Route::get('/clientes/all','App\Http\Controllers\ClientController@showall')->name('clientes.showall');
Route::get('/clientes/editar/{id}','App\Http\Controllers\ClientController@showedit')->name('clientes.edit');
Route::get('/clientes/detalleone/{id}','App\Http\Controllers\ClientController@showone')->name('clientes.nuevo');
Route::get('/clientes/agregar','App\Http\Controllers\ClientController@create')->name('clientes.create');
Route::get('/clientes/detalle/{id}','App\Http\Controllers\ClientController@show')->name('clientes.show');
Route::apiResource('clientes', 'App\Http\Controllers\ClientController');
