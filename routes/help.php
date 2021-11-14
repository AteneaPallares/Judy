Route::get('/proveedores','App\Http\Controllers\SupplierController@index')->name('proveedores.index');
Route::get('/proveedores/all','App\Http\Controllers\SupplierController@showall')->name('proveedores.showall');
Route::get('/proveedores/editar/{id}','App\Http\Controllers\SupplierController@showedit')->name('proveedores.edit');
Route::get('/proveedores/detalleone/{id}','App\Http\Controllers\SupplierController@showone')->name('proveedores.nuevo');
Route::get('/proveedores/agregar','App\Http\Controllers\SupplierController@create')->name('proveedores.create');
Route::get('/proveedores/detalle/{id}','App\Http\Controllers\SupplierController@show')->name('proveedores.show');
Route::apiResource('proveedores', 'App\Http\Controllers\SupplierController');