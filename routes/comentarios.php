<?php

use Illuminate\Support\Facades\Route;

Route::put('/comentario/{id}/{comentario}', 'ComentarioController@update')->name('comentario.update');

Route::delete('/comentario/{comentario}/eliminar', 'ComentarioController@destroy')->name('comentario.eliminar');
