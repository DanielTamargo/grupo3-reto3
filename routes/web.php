<?php

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

// RUTAS CON PRUEBAS
Route::get('/pruebas', function() {
    return view('pruebas.usuarios')
        ->with('users', App\Models\User::all())
        ->with('jefesequipos', App\Models\JefeEquipo::all())
        ->with('tecnicos', App\Models\Tecnico::all())
        ->with('operadores', App\Models\Operador::all());
})->name('pruebas.usuarios');

Route::get('/', function () {
    return view('operadores.home-operador');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Operador/nueva-averia', [App\Http\Controllers\OperadorController::class, 'nuevaAveria'])->name('nuevaAveria.create');
Route::get('/Operador/nuevo-parte', [App\Http\Controllers\OperadorController::class, 'crearParte'])->name('crearParte.create');
Route::get('/Operador/ultimas-revisiones', [App\Http\Controllers\OperadorController::class, 'mostrarUltimasRevisiones'])->name('ultimasRevisiones.show');
Route::get('/Operador/asignar-revisiones', [App\Http\Controllers\OperadorController::class, 'asignarRevisiones'])->name('asignarRevisiones.create');
