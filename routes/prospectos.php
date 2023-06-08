<?php
use Illuminate\Support\Facades\Auth;
use App\Events\ProspectosNuevosEvent;
use Illuminate\Support\Facades\Route;

Route::get('/seguimiento/index', 'ProspectoController@index')->name('cartera.index');
Route::post('/prospecto/store', 'ProspectoController@store')->name('prospecto.store');
Route::get('/prospecto/{prospecto}/show', 'ProspectoController@show')->name('prospecto.show');
Route::get('/prospecto/{prospecto}/edit', 'ProspectoController@edit')->name('prospecto.editar');
Route::post('/prospecto/correo', 'ProspectoController@enviarCorreo')->name('prospecto.correo');
Route::get('/prospecto/{prospecto}/edit', 'ProspectoController@edit')->name('prospecto.editar');
Route::put('/prospecto/{prospecto}/update', 'ProspectoController@update')->name('prospecto.actualizar');
//Notificacion de registro
Route::get('/prospectos', 'ProspectoController@notificar')->name('prospecto.notificacion');

Route::put('/tarifa/{idProspecto}','ProspectoController@autorizarTarifa')->name('autorizar.tarifa');

Route::delete('/prospecto/{prospecto}/eliminar', 'ProspectoController@destroy')->name('prospecto.eliminar');
