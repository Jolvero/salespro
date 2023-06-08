<?php

use Illuminate\Support\Facades\Route;


Route::get('/plantillas/index', 'PlantillaController@index')->name('plantillas.index');
Route::post('/plantilla/store', 'PlantillaController@store')->name('plantilla.store');
Route::get('/plantilla/{plantilla}/show', 'PlantillaController@show')->name('plantilla.show');
Route::get('/plantilla/{plantilla}/edit', 'PlantillaController@edit')->name('plantilla.editar');
Route::put('/plantilla/{id}/{plantilla}/update', 'PlantillaController@actualizarPlantilla')->name('plantilla.update');
Route::delete('/plantilla/{plantilla}/eliminar', 'PlantillaController@destroy')->name('plantilla.eliminar');
