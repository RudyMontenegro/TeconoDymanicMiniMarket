<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

/*Route::get('/', function () {
    return view('/home');
})->middleware('auth');
*/
Route::get('/', 'HomeController@index')->middleware('auth');


//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sucursal', 'SucursalController@index')->middleware('auth');

//PROVEEDOR
Route::get('/proveedor', 'ProveedorController@index')->middleware('auth');
Route::get('/proveedor/{proveedor}/show', 'ProveedorController@show')->middleware('auth');
Route::get('/proveedor/create', 'ProveedorController@create')->middleware('auth');
Route::get('/proveedor/pdf', 'ProveedorController@imprimir')->middleware('auth');
Route::post('/proveedor', 'ProveedorController@store')->middleware('auth');
Route::get('/proveedor/{proveedor}/edit', 'ProveedorController@edit')->middleware('auth');
Route::put('/proveedor/{proveedor}', 'ProveedorController@update')->middleware('auth');
Route::delete('/proveedor/{proveedor}', 'ProveedorController@destroy')->middleware('auth');
//SUCURSALES
Route::get('/sucursal', 'SucursalController@index')->middleware('auth');
Route::get('/sucursal/registrarSucursal', 'SucursalController@create')->middleware('auth');
Route::post('/sucursal/registrarSucursal', 'SucursalController@store')->middleware('auth');
Route::get('/sucursal/editar/{id}', 'SucursalController@edit')->middleware('auth')->name('sucursal.edit');
Route::patch('/sucursal/editar/{id}', 'SucursalController@update')->middleware('auth');
Route::delete('/sucursal/{id}', 'SucursalController@destroy')->middleware('auth');
Route::post('/sucursal/validar', 'SucursalController@validar')->middleware('auth');
Route::post('/sucursal/validarEditar', 'SucursalController@validarEditar')->middleware('auth');
//TRANFERENCIAS
Route::get('/transferencia', 'TransferenciaController@index')->middleware('auth');
Route::get('/transferencia/envio/{id}', 'TransferenciaController@sucursal')->middleware('auth');
Route::get('/transferencia/envioP/{id}', 'TransferenciaController@producto')->middleware('auth');
Route::get('/transferencia/envioN/{id}', 'TransferenciaController@nombre')->middleware('auth');
Route::post('/transferencia/validar', 'TransferenciaController@codigo')->middleware('auth');
Route::post('/transferencia/cantidadProducto', 'TransferenciaController@validarCantidadProducto')->middleware('auth');
Route::post('/transferencia/llenar', 'TransferenciaController@llenar')->middleware('auth');
Route::get('/transferencia/registrarTransferencia', 'TransferenciaController@create')->middleware('auth');
Route::post('/transferencia/registrarTransferencia', 'TransferenciaController@store')->middleware('auth');
Route::get('/transferencia/informacion/{id}', 'TransferenciaController@show')->middleware('auth');
Route::delete('/transferencia/{id}', 'TransferenciaController@destroy')->middleware('auth');
Route::get('/transferencia/pdf/{id}', 'TransferenciaController@imprimir')->middleware('auth');
Route::patch('/transferencia/editar/{id}', 'TransferenciaController@update')->middleware('auth');//no funciona aun
//CATEGORIA
Route::get('/producto/registrarCategoria', 'CategoriaController@create')->middleware('auth');
Route::post('/producto/registrarCategoria', 'CategoriaController@store')->middleware('auth');
Route::get('/producto/categoria/editar/{id}', 'CategoriaController@edit')->middleware('auth');
Route::patch('/producto/categoria/editar/{id}', 'CategoriaController@update')->middleware('auth');
Route::post('/categoria/validar', 'CategoriaController@validar')->middleware('auth');
Route::post('/categoria/validarEditar', 'CategoriaController@validarEditar')->middleware('auth');
//PRODUCTO
Route::get('/producto', 'ProductosController@index')->middleware('auth');
Route::get('/producto/prueba', 'ProductosController@prueba')->middleware('auth');
Route::get('/producto/filtro/{id}', 'ProductosController@filtro')->middleware('auth');
Route::get('/producto/registrarProducto', 'ProductosController@create')->middleware('auth');
Route::post('/producto/registrarProducto', 'ProductosController@store')->middleware('auth');
Route::get('/producto/{id}', 'ProductosController@show')->middleware('auth');
Route::get('/producto/editar/{id}', 'ProductosController@edit')->middleware('auth');
Route::patch('/producto/editar/{id}', 'ProductosController@update')->middleware('auth');
Route::delete('/producto/{id}', 'ProductosController@destroy')->middleware('auth');
Route::post('/producto/validar', 'ProductosController@validar')->middleware('auth');
Route::post('/producto/validarCodigo', 'ProductosController@validarCodigo')->middleware('auth');
Route::post('/producto/validarCodigoBarra', 'ProductosController@validarCodigoBarra')->middleware('auth');
Route::post('/producto/validarEditarCodigo', 'ProductosController@validarCodigoEdit')->middleware('auth');
Route::post('/producto/validarEditarCodigoBarra', 'ProductosController@validarCodigoBarraEdit')->middleware('auth');
Route::post('/producto/validarNombreEdit', 'ProductosController@validarNombreEdit')->middleware('auth');
//CLIENTE
Route::get('/cliente', 'ClienteController@index')->middleware('auth');
Route::get('/cliente/pdf', 'ClienteController@imprimir')->middleware('auth');
Route::get('/cliente/registrarCliente','ClienteController@create')->middleware('auth');
Route::post('/registrarCliente','ClienteController@store')->middleware('auth');
Route::get('/cliente/editar/{id}','ClienteController@edit')->middleware('auth');
Route::patch('/cliente/editar/{id}','ClienteController@update')->middleware('auth');
Route::delete('/cliente/{id}', 'ClienteController@destroy')->middleware('auth');
Route::post('/cliente/validar', 'ClienteController@validar')->middleware('auth');
//VENTA
Route::get('/venta', 'VentaController@index')->middleware('auth');
Route::get('/venta/{id}/show', 'VentaController@show')->middleware('auth');
Route::get('/venta/create', 'VentaController@create')->middleware('auth');
Route::get('/venta/envioP/{id}', 'VentaController@getProducto')->middleware('auth');
Route::get('/venta/envioName/{id}', 'VentaController@nombre')->middleware('auth');
Route::get('/venta/envioNit/{id}', 'VentaController@getCliente')->middleware('auth');
Route::post('/venta', 'VentaController@store')->middleware('auth');
Route::get('/venta/pdf', 'VentaController@imprimir')->middleware('auth');
Route::get('/venta/{ventas}/edit', 'VentaController@edit')->middleware('auth');
Route::put('/venta/{ventas}', 'VentaController@update')->middleware('auth');
Route::delete('/venta/{ventas}', 'VentaController@destroy')->middleware('auth');  
Route::post('/venta/validarCodigoProducto', 'VentaController@validarCodigo')->middleware('auth');
// 
Route::post('/autoCompletName', 'VentaController@fetchName');
Route::post('/autoCompleteNit', 'VentaController@fetchNitR');
Route::post('/autoCompleteCodigoP', 'VentaController@fetchCodigoP');
Route::post('/autoCompleteNombreP', 'VentaController@fetchNombreProducto');
Route::get('/autocompleteNit/{id}', 'VentaController@fetchNit');
Route::get('/venta/envioN/{id}', 'TransferenciaController@nombre')->middleware('auth');
//COMPRA
Route::get('/compra', 'CompraController@index')->middleware('auth');
Route::get('/compra/registrarCompra','CompraController@create')->middleware('auth');
Route::get('/compra/envioP/{id}', 'CompraController@producto')->middleware('auth');
Route::get('/compra/envioN/{id}', 'CompraController@nombre')->middleware('auth');
Route::get('/compra/envioNit/{id}', 'CompraController@nombre')->middleware('auth');
Route::get('/compra/edit/{id}', 'CompraController@edit')->middleware('auth');
Route::post('/compra/registrarCompra','CompraController@store')->middleware('auth');
Route::get('/compra/view/{id}', 'CompraController@show')->middleware('auth');
Route::get('/compra/pdf', 'CompraController@imprimir')->middleware('auth');
Route::patch('/compra/edit/{id}', 'CompraController@update')->middleware('auth');
Route::delete('/compra/{compras}', 'CompraController@destroy')->middleware('auth');
Route::post('/compra/llenar', 'ClienteController@llenado')->middleware('auth');

Route::get('/compra/{id}', 'CompraController@show')->middleware('auth');    
//jquery
