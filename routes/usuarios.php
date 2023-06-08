<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/users/index', 'UserController@index')->name('usuarios.index');
Route::post('/users/store', 'UserController@store')->name('usuario.agregar');
Route::get('/users/{user}/editar', 'UserController@edit')->name('usuario.editar');
Route::put('/users/{user}/update', 'UserController@update')->name('usuario.update');
Route::delete('/usuario/{user}/eliminar', 'UserController@destroy')->name('usuario.eliminar');
