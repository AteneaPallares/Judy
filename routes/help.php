Route::get('/pedidos','App\Http\Controllers\OrderController@index')->name('pedidos.index');
Route::get('/pedidos/all','App\Http\Controllers\OrderController@showall')->name('pedidos.showall');
Route::get('/pedidos/editar/{id}','App\Http\Controllers\OrderController@showedit')->name('pedidos.edit');
Route::get('/pedidos/detalleone/{id}','App\Http\Controllers\OrderController@showone')->name('pedidos.nuevo');
Route::get('/pedidos/agregar','App\Http\Controllers\OrderController@create')->name('pedidos.create');
Route::get('/pedidos/detalle/{id}','App\Http\Controllers\OrderController@show')->name('pedidos.show');
Route::apiResource('pedidos', 'App\Http\Controllers\OrderController');