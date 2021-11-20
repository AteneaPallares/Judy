Route::get('/ventas','App\Http\Controllers\SaleController@index')->name('ventas.index');
Route::get('/ventas/all','App\Http\Controllers\SaleController@showall')->name('ventas.showall');
Route::get('/ventas/editar/{id}','App\Http\Controllers\SaleController@showedit')->name('ventas.edit');
Route::get('/ventas/detalleone/{id}','App\Http\Controllers\SaleController@showone')->name('ventas.nuevo');
Route::get('/ventas/agregar','App\Http\Controllers\SaleController@create')->name('ventas.create');
Route::get('/ventas/detalle/{id}','App\Http\Controllers\SaleController@show')->name('ventas.show');
Route::apiResource('ventas', 'App\Http\Controllers\SaleController');