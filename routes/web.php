<?php

use App\Events\ProspectosNuevos;
use App\Events\ProspectosNuevosEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'InicioController@index'
)->name('inicio.index');

Auth::routes(['register' => false]);

// Dashboard
Route::get('/index', 'DashboardController@index')->name('index');
Route::get('/clientes/mes', 'ClienteController@obtenerClientesMes');
Route::get('/prospectos/mes', 'ProspectoController@obtenerProspectosMes');
Route::get('/prospectos/nombres', 'ProspectoController@prospectosLabels');
Route::get('/clientes/nombres', 'ClienteController@clientesLabels');

// mailing

Route::get('/email', 'ProspectoController@mailing')->name('correo.mailing');
Route::get('/tipo/{tipo}/clientes-prospectos', 'ProspectoController@tipoClienteProspecto');
Route::post('/mailing/store', 'ProspectoController@mailingStore')->name('mailing.store');
Route::get('/correo/prueba', 'ProspectoController@correoPrueba');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/evento', 'DashBoardController@evento');
Route::get('/home', function()
{
    return 'home';
});

Route::get('storage-link', function () {
    if (file_exists(public_path('storage'))) {
        return 'The "public/storage" directory already exists.';
    }
    app('files')->link(
        storage_path('app/public'),
        public_path('storage')
    );
    return 'The [public/storage] directory has been linked';
});

// Notificaciones
Route::get('/notificaciones', 'NotificacionController')->middleware(['auth', 'notificacion'])->name('notificaciones.index');

