Route::get('/productos','App\Http\Controllers\ProductController@index')->name('productos.index');
Route::get('/productos/all','App\Http\Controllers\ProductController@showall')->name('productos.showall');
Route::get('/productos/editar/{id}','App\Http\Controllers\ProductController@showedit')->name('productos.edit');
Route::get('/productos/detalleone/{id}','App\Http\Controllers\ProductController@showone')->name('productos.nuevo');
Route::get('/productos/agregar','App\Http\Controllers\ProductController@create')->name('productos.create');
Route::get('/productos/detalle/{id}','App\Http\Controllers\ProductController@show')->name('productos.show');
Route::apiResource('productos', 'App\Http\Controllers\ProductController');