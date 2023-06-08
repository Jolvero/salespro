<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/clientes/index', 'ClienteController@index')->name('clientes.index');
Route::get('/clientes/{cliente}/show', 'ClienteController@show')->name('cliente.show');
Route::get('/clientes/{cliente}/editar', 'ClienteController@edit')->name('cliente.editar');
Route::get('/cliente/dashboard', 'ClienteController@contarClientes');
Route::put('/cliente/{cliente}/update', 'ClienteController@update')->name('cliente.update');
Route::delete('/cliente/{cliente}/eliminar', 'ClienteController@destroy')->name('cliente.eliminar');
