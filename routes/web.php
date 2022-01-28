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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', function () {
    return view('login');
})->name("login");
Route::get('/hometecnico', function() {
    return view('tecnicos.home');
})->name("tecnico.home");
Route::get('/createtecnico', function() {
    return view('tecnicos.create');
})->name("tecnico.create");
Route::get('/showtecnico', function() {
    return view('tecnicos.show');
})->name("tecnico.show");
Route::get('/historialtecnico', function() {
    return view('tecnicos.historial');
})->name("tecnico.historial");
Route::get('/manualtecnico', function() {
    return view('tecnicos.manual');
})->name("tecnico.manual");
Route::get('/piezastecnico', function() {
    return view('tecnicos.piezas');
})->name("tecnico.piezas");