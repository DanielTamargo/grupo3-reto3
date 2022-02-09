<?php

use Illuminate\Http\Request;
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
Route::get('/api/v1/ascensores', [App\Http\Controllers\Api\V1\ApiController::class, 'obtenerAscensores']);
Route::get('/api/v1/codigosJefes', [App\Http\Controllers\Api\V1\ApiController::class, 'codigosJefes']);
Route::get('/api/v1/tecnicos-disponibles', [App\Http\Controllers\Api\V1\ApiController::class, 'obtenerTecnicosDisponibles']);
Route::get('/api/v1/estadisticas', [App\Http\Controllers\Api\V1\ApiController::class, 'obtenerEstadisticas']);
Route::get('/api/v1/tareas', [App\Http\Controllers\Api\V1\ApiController::class, 'obtenerTareas']);

/*
----------------------------------------------------------------------------------------------
RUTAS CON PRUEBAS
----------------------------------------------------------------------------------------------
*/
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
Route::get('/pruebas/ficheros', function() {
    return view('pruebas.ficheros');
})->name('pruebas.ficheros');

/*
----------------------------------------------------------------------------------------------
DESCARGAR FICHERO
----------------------------------------------------------------------------------------------
*/
Route::get('/descargar/manual/{manual_nombre}', [\App\Http\Controllers\DownloadController::class, 'descargarManual'])
    ->middleware('auth')
    ->name('descargar.manual.modelo');

/*
----------------------------------------------------------------------------------------------
EMAILS
----------------------------------------------------------------------------------------------
*/
// Se llamará a la clase Mail cuando se necesite enviar email, no hay necesidad de utilizar controladores intermedios
// Route::get('/send/email/cliente', [App\Http\Controllers\EmailController::class, 'notificarCliente'])->name('email.cliente');

/*
----------------------------------------------------------------------------------------------
LOGIN / REGISTRAR NUEVO USUARIO
----------------------------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('login');
})->name("login");
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->name("login");
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])
    ->middleware('auth') // <- Necesario estar loggeado! Un usuario no se puede registrar por su cuenta!
    ->name("register.create");
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])
    ->middleware('auth') // <- Necesario estar loggeado! Un usuario no se puede registrar por su cuenta!
    ->name('register.store');


/*
----------------------------------------------------------------------------------------------
INICIO / HOME
----------------------------------------------------------------------------------------------
*/
Route::get('/home', function() {
    return redirect()->route('inicio');
})->name('home');
Route::get('/', [App\Http\Controllers\GeneralController::class, 'inicio'])
  ->middleware('auth')
  ->name('inicio');


/*
----------------------------------------------------------------------------------------------
TECNICOS
----------------------------------------------------------------------------------------------
*/
// que datos usara el home?
Route::get('/tecnico', function() {
    // validacion
    if (!Auth::user()) {
        return view('errors.403');
    }
    return view('tecnicos.home', ['usuario' => Auth::user()->nombre]);
})->name("tecnico.home");

Route::get('/tecnico/nueva-parte/{idtarea}', [App\Http\Controllers\TecnicoController::class, 'nuevaParte'])->name("tecnico.create");
Route::get('/tecnico/tareas', [App\Http\Controllers\TecnicoController::class, 'showTareas'])->name("tecnico.show");
Route::get('/tecnico/historial', [App\Http\Controllers\TecnicoController::class, 'showHistorialDefault'])->name("tecnico.historial");
Route::get('/tecnico/manuales', [App\Http\Controllers\TecnicoController::class, 'showManual'])->name("tecnico.manual");
Route::get('/tecnico/piezas', [App\Http\Controllers\TecnicoController::class, 'piezas'])->name("tecnico.piezas");

Route::post('/tecnico/partes', [App\Http\Controllers\ParteController::class, 'store'])->name('partes.store');
Route::post('/tecnico/historial', [App\Http\Controllers\TecnicoController::class, 'showHistorial'])->name("tecnico.searchhistorial");

/*
----------------------------------------------------------------------------------------------
OPERADORES
----------------------------------------------------------------------------------------------
*/
Route::get('/operador', function () {return view('operadores.home-operador')->with('home',true);})->name('home.operador');
Route::get('/operador/nueva-tarea', [App\Http\Controllers\OperadorController::class, 'nuevaTarea'])->name('nuevatarea.create');
Route::post('/operador/nueva-tarea', [App\Http\Controllers\OperadorController::class, 'crearTarea'])->name('tarea.store');
Route::get('/operador/listar-tareas', [App\Http\Controllers\OperadorController::class, 'listarTareas'])->name('tareas.index');

/*
----------------------------------------------------------------------------------------------
JEFES DE EQUIPO
----------------------------------------------------------------------------------------------
*/
Route::get('/jefes', function () {return view('jefes.home-jefes')->with('home',true);})
    ->middleware('auth')->name('home.jefe');
Route::get('/estadisticas', [App\Http\Controllers\Estadisticas::class, 'mostrar'])
->middleware('auth')->name('estadisticas.create');
Route::get('/estadisticas/mostrar', function () {return view('estadisticas');})
->middleware('auth')->name('estadisticas');

/*
----------------------------------------------------------------------------------------------
EMPLEADOS
----------------------------------------------------------------------------------------------
*/
Route::get('/empleados', [App\Http\Controllers\EmpleadoController::class, 'listarEmpleados'])
    ->middleware('auth')->name('empleados.index');
Route::get('/empleados/nuevo', [App\Http\Controllers\Auth\RegisterController::class, 'create'])
    ->middleware('auth')->name('empleados.new');
Route::get('/empleados/{user_id}', [App\Http\Controllers\EmpleadoController::class, 'mostrarEmpleado'])
      ->middleware('auth')->name('empleados.show');
Route::put('/empleados/{user_id}', [App\Http\Controllers\EmpleadoController::class, 'editarEmpleado'])
    ->middleware('auth')->name('empleados.edit');
Route::delete('/empleados/{user_id}', [App\Http\Controllers\EmpleadoController::class, 'eliminarEmpleado'])
    ->middleware('auth')->name('empleados.delete'); // TODO

/* EXPORTS */
Route::get('/empleados/export/excel', [App\Http\Controllers\EmpleadoController::class, 'exportarExcel'])
    ->middleware('auth')->name('empleados.export.excel');
Route::get('/empleados/export/csv', [App\Http\Controllers\EmpleadoController::class, 'exportarCSV'])
    ->middleware('auth')->name('empleados.export.csv');

/*
----------------------------------------------------------------------------------------------
ADMINISTRADORES
----------------------------------------------------------------------------------------------
*/
Route::get('/administrador', function (Request $request) {
    return view('administradores.home')->with('home',true)->with('usuario_creado', $request->usuario_creado);
})->middleware('auth')->name('administrador.home');

/*
----------------------------------------------------------------------------------------------
GENERAL
----------------------------------------------------------------------------------------------
*/
Route::get('/ascensores', [App\Http\Controllers\GeneralController::class, 'indexAscensores'])
    ->middleware('auth')->name('ascensores.index');


/*
----------------------------------------------------------------------------------------------
MODELOS
----------------------------------------------------------------------------------------------
*/
Route::get('/modelos', [App\Http\Controllers\GeneralController::class, 'indexModelos'])
    ->middleware('auth')->name('modelos.index'); // TODO
Route::get('/modelos/{id}', [App\Http\Controllers\ModeloController::class, 'show'])
    ->middleware('auth')->name('modelos.show');
Route::post('/modelos/{id}/actualizar', [App\Http\Controllers\ModeloController::class, 'store'])
    ->middleware('auth')->name('modelos.store');

