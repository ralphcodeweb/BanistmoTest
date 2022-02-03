<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de Login
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('clientes', 'Api\ClientesController@getClientes');
Route::get('clientes/{id}', 'Api\ClientesController@getClienteId');

Route::post('clientes/registro', 'Api\ClientesController@registrarClientes');
Route::put('clientes/update', 'Api\ClientesController@actualizarClientes');

Route::delete('clientes/delete/{id}', 'Api\ClientesController@eliminarClientes');
Route::put('clientes/delete/{id}', 'Api\ClientesController@eliminarClientes');

Route::get('clientes/servicios/{id}', 'Api\ClientesController@verServiciosCliente');
