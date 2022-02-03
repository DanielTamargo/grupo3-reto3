<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\JefeEquipo;
use App\Models\Tarea;
use App\Models\Tecnico;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function ascensores() {
        $user = Auth::user();

        // Comprobamos que es un usuario registrado
        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                'rol' =>  'invitado'
            ]);
        }
        
        $ascensores = \App\Models\Ascensor::all();
        return response()->json([
            'ok' => true,
            'ascensores' => $ascensores,
            'message' => 'Petición válida',
            'rol' => $user->rol,
        ], 200);

    }

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
                'jefes' => [$user->puesto->codigo => $user->nombre . " " . $user->apellidos],
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

    public function obtenerEstadisticas(){
        $datos_tecnicos = Tecnico::all();
        $datos_tareas = Tarea::all();

        $datos_tecnico_estadisticas = [];
        $datos_tarea_estadisticas = [];

        foreach ($datos_tecnicos as $datos_tecnico){
            array_push($datos_tecnico_estadisticas,['codigo'=>$datos_tecnico['codigo'],'jefe_codigo'=>$datos_tecnico['jefe_codigo']]);
        }   
        foreach ($datos_tareas as $datos_tarea){
            array_push($datos_tarea_estadisticas,['tipo'=>$datos_tarea['tipo'],'estado'=>$datos_tarea['estado'],'ascensor_ref'=>$datos_tarea['ascensor_ref'],'tecnico_codigo'=>$datos_tarea['tecnico_codigo']]);
        }   
        
        return response()->json([
            'ok' => true,
            'datos_tecnico' => $datos_tecnico_estadisticas,
            'datos_tarea' => $datos_tarea_estadisticas,
            'message'=> 'Petición valida'
        ], 200);
    }


}
