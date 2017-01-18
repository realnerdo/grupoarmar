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

Route::get('/', 'HomeController@index');

// Usuarios
Route::get('usuarios', 'UserController@index');
Route::post('usuarios', 'UserController@store');
Route::get('usuarios/nuevo', 'UserController@create');
Route::patch('usuarios/{user}', 'UserController@update');
Route::delete('usuarios/{user}', 'UserController@destroy');
Route::get('usuarios/{user}/editar', 'UserController@edit');
Route::get('usuarios/exportExcel', 'UserController@exportExcel');

// Permisos
Route::get('permisos', 'PermissionController@index');
Route::post('permisos', 'PermissionController@store');
Route::get('permisos/nuevo', 'PermissionController@create');
Route::patch('permisos/{permission}', 'PermissionController@update');
Route::delete('permisos/{permission}', 'PermissionController@destroy');
Route::get('permisos/{permission}/editar', 'PermissionController@edit');

// Almacenes
Route::get('almacenes', 'WarehouseController@index');
Route::post('almacenes', 'WarehouseController@store');
Route::get('almacenes/nuevo', 'WarehouseController@create');
Route::patch('almacenes/{warehouse}', 'WarehouseController@update');
Route::delete('almacenes/{warehouse}', 'WarehouseController@destroy');
Route::get('almacenes/{warehouse}/editar', 'WarehouseController@edit');
Route::get('almacenes/exportExcel', 'WarehouseController@exportExcel');

// Proveedores
Route::get('proveedores', 'SupplierController@index');
Route::post('proveedores', 'SupplierController@store');
Route::get('proveedores/nuevo', 'SupplierController@create');
Route::patch('proveedores/{supplier}', 'SupplierController@update');
Route::delete('proveedores/{supplier}', 'SupplierController@destroy');
Route::get('proveedores/{supplier}/editar', 'SupplierController@edit');
Route::get('proveedores/exportExcel', 'SupplierController@exportExcel');

// Grupos
Route::get('grupos', 'GroupController@index');
Route::post('grupos', 'GroupController@store');
Route::get('grupos/nuevo', 'GroupController@create');
Route::patch('grupos/{group}', 'GroupController@update');
Route::delete('grupos/{group}', 'GroupController@destroy');
Route::get('grupos/{group}/editar', 'GroupController@edit');
Route::get('grupos/exportExcel', 'GroupController@exportExcel');

// Marcas
Route::get('marcas', 'BrandController@index');
Route::post('marcas', 'BrandController@store');
Route::get('marcas/nuevo', 'BrandController@create');
Route::patch('marcas/{brand}', 'BrandController@update');
Route::delete('marcas/{brand}', 'BrandController@destroy');
Route::get('marcas/{brand}/editar', 'BrandController@edit');
Route::get('marcas/exportExcel', 'BrandController@exportExcel');

// Equipos
Route::get('equipos', 'EquipmentController@index');
Route::post('equipos', 'EquipmentController@store');
Route::get('equipos/nuevo', 'EquipmentController@create');
Route::patch('equipos/{equipment}', 'EquipmentController@update');
Route::delete('equipos/{equipment}', 'EquipmentController@destroy');
Route::get('equipos/{equipment}/editar', 'EquipmentController@edit');
Route::get('equipos/getEquipments', 'EquipmentController@getEquipments');
Route::get('equipos/getEquipmentById/{id}', 'EquipmentController@getEquipmentById');
Route::get('equipos/exportExcel', 'EquipmentController@exportExcel');

// Clientes
Route::get('clientes', 'ClientController@index');
Route::post('clientes', 'ClientController@store');
Route::get('clientes/nuevo', 'ClientController@create');
Route::patch('clientes/{client}', 'ClientController@update');
Route::delete('clientes/{client}', 'ClientController@destroy');
Route::get('clientes/{client}/editar', 'ClientController@edit');
Route::get('clientes/getClientById/{id}', 'ClientController@getClientById');
Route::get('clientes/exportExcel', 'ClientController@exportExcel');
// Route::get('clientes/exportPdf', 'ClientController@exportPdf');

// Servicios
Route::get('servicios', 'ServiceController@index');
Route::post('servicios', 'ServiceController@store');
Route::get('servicios/nuevo', 'ServiceController@create');
Route::patch('servicios/{service}', 'ServiceController@update');
Route::delete('servicios/{service}', 'ServiceController@destroy');
Route::get('servicios/{service}/editar', 'ServiceController@edit');
Route::get('servicios/exportExcel', 'ServiceController@exportExcel');

// Mantenimientos
Route::get('mantenimientos', 'MaintenanceController@index');
Route::post('mantenimientos', 'MaintenanceController@store');
Route::get('mantenimientos/nuevo', 'MaintenanceController@create');
Route::patch('mantenimientos/{maintenance}', 'MaintenanceController@update');
Route::delete('mantenimientos/{maintenance}', 'MaintenanceController@destroy');
Route::get('mantenimientos/{maintenance}/editar', 'MaintenanceController@edit');
Route::get('mantenimientos/exportExcel', 'MaintenanceController@exportExcel');

// Ajustes
Route::get('ajustes', 'SettingController@index');
Route::patch('ajustes/{setting}', 'SettingController@update');
