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


// Rutas Auth, las ponemos arriba para sobreescribir las que creamos conveniente
Auth::routes();

/*
----------------------------------------------------------------------------------------------
APIS
----------------------------------------------------------------------------------------------
*/
Route::get('/api/v1/codigosJefes', [App\Http\Controllers\Api\V1\ApiController::class, 'codigosJefes']);

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


/*
----------------------------------------------------------------------------------------------
LOGIN / REGISTRAR NUEVO USUARIO
----------------------------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name("login");
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])
    ->middleware('auth')
    ->name("register.create");
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])
    ->middleware('auth')
    ->name('register.store');


/*
----------------------------------------------------------------------------------------------
INICIO / HOME
----------------------------------------------------------------------------------------------
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function ($usuario_creado=false) {
    return view('welcome')->with('usuario_creado', $usuario_creado);
})->name('inicio');


/*
----------------------------------------------------------------------------------------------
TECNICOS
----------------------------------------------------------------------------------------------
*/
Route::get('/tecnico', function() {
    return view('tecnicos.home');
})->name("tecnico.home");

Route::get('/tecnico/nueva-parte', [App\Http\Controllers\TecnicoController::class, 'nuevaParte'])->name("tecnico.create");
Route::get('/tecnico/tareas', [App\Http\Controllers\TecnicoController::class, 'showTareas'])->name("tecnico.show");
Route::get('/tecnico/historial', [App\Http\Controllers\TecnicoController::class, 'showHistorial'])->name("tecnico.historial");
Route::get('/tecnico/manuales', [App\Http\Controllers\TecnicoController::class, 'showManual'])->name("tecnico.manual");
Route::get('/tecnico/piezas', [App\Http\Controllers\TecnicoController::class, 'piezas'])->name("tecnico.piezas");


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

