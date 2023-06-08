<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/cotizacion/{cotizacion}', 'CotizacionController@show')->name('cotizacion.show');
