<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/recordatorios/index', 'RecordatorioController@index')->name('recordatorio.index');
Route::post('/recordatorio/store', 'RecordatorioController@store')->name('recordatorio.agregar');
Route::get('/recordatorio/{recordatorio}', 'RecordatorioController@show')->name('recordatorio.show');
Route::get('/recordatorio/{recordatorio}/edit', 'RecordatorioController@edit')->name('recordatorio.editar');
Route::put('/recordatorio/{recordatorio}/update', 'RecordatorioController@update')->name('recordatorio.update');
Route::delete('/recordatorio/{recordatorio}/eliminar', 'RecordatorioController@destroy')->name('recordatorio.destroy');

Route::get('/recordatorio/{fecha}/aviso', 'RecordatorioController@aviso')->name('recordatorio.aviso');

