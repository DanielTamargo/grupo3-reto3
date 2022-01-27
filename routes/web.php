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
});
Route::get('/homeTecnico', function() {
    return view('tecnicos.home');
});
Route::get('/createTecnico', function() {
    return view('tecnicos.create');
});
Route::get('/showTecnico', function() {
    return view('tecnicos.show');
});
Route::get('/historialTecnico', function() {
    return view('tecnicos.historial');
});