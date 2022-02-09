<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ascensor;
use App\Models\JefeEquipo;
use App\Models\Tarea;
use App\Models\Tecnico;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * API cuya respuesta devuelve una lista de los técnicos disponibles con datos adicionales como
     * nombre del jefe de equipo asignado, número de tareas pendientes y número de averías pendientes
     *
     * Login necesario: sí
     * Rol necesario: administrador u operador
     */
    public function obtenerTecnicosDisponibles() {
        $user = Auth::user();

        // Comprobamos que es un usuario registrado y que dispone de los privilegios necesarios
        if (!$user || ($user->rol != "operador" && $user->rol != "administrador")) {
            return response()->json([
                'ok' => false,
                'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                'rol' =>  'invitado'
            ]);
        }

        $tecnicos = \App\Models\Tecnico::all();
        $tecnicos_respuesta = [];

        // Parseamos cada técnico para completar la información que necesita la respuesta
        foreach($tecnicos as $tecnico) {
            $tecnico["num_tareas_pdtes"] = count(\App\Models\Tarea::where('tecnico_codigo', $tecnico->codigo)
                                                            ->whereIn('estado', ['sintratar', 'retrasado', 'materialrequerido'])->get());
            $tecnico["num_urgencias_pdtes"] = count(\App\Models\Tarea::where('tecnico_codigo', $tecnico->codigo)
                                                            ->whereIn('estado', ['sintratar', 'retrasado', 'materialrequerido'])
                                                            ->where('prioridad', '>=', 5)->get());
            $tecnico["jefe_nombre"] = $tecnico->jefe->user->nombre . " " . $tecnico->jefe->user->apellidos;
            $tecnico["nombre"] = $tecnico->user->nombre . " " . $tecnico->user->apellidos;
            array_push($tecnicos_respuesta, $tecnico);
        }


        return response()->json([
            'ok' => true,
            'tecnicos' => $tecnicos_respuesta,
            'message' => 'Petición válida',
            'rol' => $user->rol,
        ], 200);

    }

    /**
     * API cuya respuesta devuelve una lista de ascensores instalados y los modelos para sonsacar
     * datos en base a la relación
     *
     * Login necesario: sí
     */
    public function obtenerAscensores() {
        $user = Auth::user();

        // Comprobamos que es un usuario registrado
        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                'rol' =>  'invitado'
            ]);
        }

        // Obtenemos los filtros
        $filtro_numref = $_GET["filtro_numref"];
        $filtro_ubicacion = $_GET["filtro_ubicacion"];

        $ascensores = \App\Models\Ascensor::where('num_ref', 'like', "%$filtro_numref%")->where('ubicacion', 'like', "%$filtro_ubicacion%")->get();
        $modelos = \App\Models\Modelo::all();

        return response()->json([
            'ok' => true,
            'ascensores' => $ascensores,
            'modelos' => $modelos,
            'message' => 'Petición válida',
            'rol' => $user->rol,
        ], 200);

    }

    /**
     * API cuya respuesta un array asociativo con los datos de los jefes, nombre, código y número de técnicos
     *
     * Login necesario: sí
     * Rol necesario: administrador o jefeequipo
     */
    public function codigosJefes() {
        $user = Auth::user();

        // Comprobamos que es un usuario registrado
        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                'rol' =>  'invitado'
            ]);
        }

        // Comprobamos que tiene permisos
        if ($user->rol != "administrador" && $user->rol != "jefeequipo") {
            return response()->json([
                'ok' => false,
                'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                'rol' => $user->rol
            ]);
        }

        // Si es jefe de equipo, solo devolvemos su código (solo podrá seleccionarse a sí mismo)
        if ($user->rol == "jefeequipo") {
            return response()->json([
                'ok' => true,
                'jefes' => [$user->puesto->codigo => [
                    'codigo' => $user->puesto->codigo,
                    'nombre' => $user->nombre . " " . $user->apellidos,
                    'num_tecnicos' => count($user->puesto->tecnicos)
                ]],
                'message' => 'Petición válida', 'rol' => $user->rol,
            ], 200);
        }

        // Si es admin, recogemos todos los códigos y los devolvemos
        $codigos_jefes = [];
        $jefes = JefeEquipo::all();
        foreach ($jefes as $jefe) {
            $codigos_jefes[$jefe->codigo] = [
                "nombre" => $jefe->user->nombre . " " . $jefe->user->apellidos,
                "codigo" => $jefe->codigo,
                "num_tecnicos" => count($jefe->tecnicos),
            ];
        }

        return response()->json([
            'ok' => true,
            'jefes' => $codigos_jefes,
            'message' => 'Petición válida',
            'rol' => $user->rol,
        ], 200);
    }

    /**
     * API cuya respuesta un array asociativo con los datos de los jefes, nombre, código y número de técnicos
     *
     * Login necesario: sí
     * Rol necesario: administrador o jefeequipo
     */
    public function obtenerEstadisticas() {
        $user = Auth::user();

        // Comprobamos que es un usuario registrado
        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                'rol' =>  'invitado'
            ]);
        }

        // Comprobamos que tiene permisos
        if ($user->rol != "administrador" && $user->rol != "jefeequipo") {
            return response()->json([
                'ok' => false,
                'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                'rol' => $user->rol
            ]);
        }

        $datos_tecnicos = Tecnico::all();
        $datos_tareas = Tarea::all();

        $datos_tecnicos_estadisticas = [];
        $datos_tareas_estadisticas = [];

        foreach ($datos_tecnicos as $datos_tecnico){
            array_push($datos_tecnicos_estadisticas,['codigo'=>$datos_tecnico['codigo'],'jefe_codigo'=>$datos_tecnico['jefe_codigo']]);
        }
        foreach ($datos_tareas as $datos_tarea){
            array_push($datos_tareas_estadisticas,['tipo'=>$datos_tarea['tipo'],'estado'=>$datos_tarea['estado'],'ascensor_ref'=>$datos_tarea['ascensor_ref'],'tecnico_codigo'=>$datos_tarea['tecnico_codigo'],'fecha_fin'=>$datos_tarea['fecha_finalizacion']]);
        }
        $user = Auth::user();
        return response()->json([
            'ok' => true,
            'datos_tecnico' => $datos_tecnicos_estadisticas,
            'datos_tarea' => $datos_tareas_estadisticas,
            'message'=> 'Petición valida',
            'rol' => $user->rol,
            'cod_jefe'=>$user->puesto->codigo
        ], 200);
    }

    public function obtenerTareas(){
        if(Auth::user()->rol !='tecnico'){
            $ascensores = Ascensor::all();
            $tecnicos = Tecnico::all();

            $filtro_numref = $_GET["filtro_numref"];
            $filtro_tipo = $_GET["filtro_tipo"];
            $filtro_estado = $_GET["filtro_estado"];
            if(Auth::user()->rol == 'administrador'){
                $tareas = Tarea::where('ascensor_ref', 'like', "%$filtro_numref%")
                        ->where('tipo','like',"%$filtro_tipo%")
                        ->where('estado','like',"%$filtro_estado%")
                        ->orderBy('id', 'desc')
                        ->get();
            }
            if(Auth::user()->rol == 'jefeequipo'){
                //$tareas = Tarea::where('ascensor_ref', 'like', "%$filtro_numref%")->where('tipo','like',"%$filtro_tipo%")->where('estado','like',"%$filtro_estado%")->where()->get();
                $tareas = array_filter(Tarea::where('ascensor_ref', 'like', "%$filtro_numref%")
                                            ->where('tipo','like',"%$filtro_tipo%")
                                            ->where('estado','like',"%$filtro_estado%")
                                            ->orderBy('id', 'desc')
                                            ->get()
                                            ->toArray(), function($tar) {
                    // dd(array_column(Auth::user()->puesto->tecnicos->toArray(), "codigo"));
                    return in_array($tar['tecnico_codigo'], array_column(Auth::user()->puesto->tecnicos->toArray(), "codigo"));
                });
                // dd($tareas);
                $tareas = array_values($tareas);
            }
            $tecnicos = Tecnico::all();
            return response()->json([
                'ok' => true,
                'tareas' => $tareas,
                'filtro' => $filtro_estado,
<<<<<<< HEAD
                'tecnicos' => $tecnicos
=======
                'ascensores' => $ascensores,
                'tecnicos' => $tecnicos,
>>>>>>> 6e29abed016fdeac7baeec5cf700a3b4c3167153
            ], 200);
        }
    }

}
