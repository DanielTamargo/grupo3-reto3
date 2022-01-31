<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; //<- para que no salte el error todo el rato! >:[

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
        ->with('operadores', App\Models\Operador::all())
        ->with('mostrar_usuarios', true)
        ->with('modelos', App\Models\Modelo::all())
        ->with('ascensores', App\Models\Ascensor::all())
        ->with('mostrar_modelos', true);
})->name('pruebas.usuarios');

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


/*
----------------------------------------------------------------------------------------------
OPERADORES
----------------------------------------------------------------------------------------------
*/

Route::get('/operador', function () {return view('operadores.home-operador');})->name('home.operador');
Route::get('/operador/nueva-averia', [App\Http\Controllers\OperadorController::class, 'nuevaAveria'])->name('nuevaaveria.create');
Route::get('/operador/nuevo-parte', [App\Http\Controllers\OperadorController::class, 'crearParte'])->name('crearparte.create');
Route::get('/operador/ultimas-revisiones', [App\Http\Controllers\OperadorController::class, 'mostrarUltimasRevisiones'])->name('ultimasrevisiones.show');
Route::get('/operador/asignar-revisiones', [App\Http\Controllers\OperadorController::class, 'asignarRevisiones'])->name('asignarrevisiones.create');

/*
----------------------------------------------------------------------------------------------
JEFES DE EQUIPO
----------------------------------------------------------------------------------------------
*/

Route::get('/jefes', function () {return view('jefes.home-jefes');})->name('home.jefe');
Route::get('/jefes/estadisticas', [App\Http\Controllers\JefeEquipoController::class, 'estadisticasShow'])->name('estadisticas.show');
Route::get('/jefes/nuevosusuarios', [App\Http\Controllers\JefeEquipoController::class, 'mostrarVistaNuevosUsuarios'])->name('usuarios.create');
Route::get('/jefes/borrarusuarios', [App\Http\Controllers\JefeEquipoController::class, 'mostrarVistaBorrarUsuarios'])->name('usuarios.borrar.create');
// Route::get('/jefes/borrarUsuarios/{id}', [App\Http\Controllers\JefeEquipoController::class, 'borrarUsuarios'])->name('usuarios.delete');
Route::get('/jefes/modificarusuarios', [App\Http\Controllers\JefeEquipoController::class, 'mostrarVistaModificarUsuarios'])->name('usuarios.modificar.create');
Route::get('/jefes/subirmanuales', [App\Http\Controllers\JefeEquipoController::class, 'mostrarVistaSubirManuales'])->name('manuales.create');
Route::get('/jefes/historiales', [App\Http\Controllers\JefeEquipoController::class, 'mostrarVistaHistorial'])->name('historial.create');

