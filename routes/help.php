Route::get('/iva','App\Http\Controllers\IvaController@index')->name('iva.index');
Route::get('/iva/all','App\Http\Controllers\IvaController@showall')->name('iva.showall');
Route::get('/iva/editar/{id}','App\Http\Controllers\IvaController@showedit')->name('iva.edit');
Route::get('/iva/detalleone/{id}','App\Http\Controllers\IvaController@showone')->name('iva.nuevo');
Route::get('/iva/agregar','App\Http\Controllers\IvaController@create')->name('iva.create');
Route::get('/iva/detalle/{id}','App\Http\Controllers\IvaController@show')->name('iva.show');
Route::apiResource('iva', 'App\Http\Controllers\IvaController');