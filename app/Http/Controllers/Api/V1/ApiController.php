<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\JefeEquipo;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
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


}
