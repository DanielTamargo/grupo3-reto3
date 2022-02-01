<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Enums\Roles;
use App\Models\JefeEquipo;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function codigosJefes() {
        $user = Auth::user();

        // Comprobamos que tiene permisos
        if ($user->rol != "administrador" && $user->rol != "jefeequipo") {
            return response()->json([
                'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                'rol' => $user->rol
            ]);
        }

        // Si es jefe de equipo, solo devolvemos su código (solo podrá seleccionarse a sí mismo)
        if ($user->rol == "jefeequipo") {
            return response()->json(['jefes' => [$user->puesto->codigo => $user->nombre], 'message' => 'Petición válida', 'rol' => $user->rol], 200);
        }

        $codigos_jefes = [];
        $jefes = JefeEquipo::all();
        foreach ($jefes as $jefe) {
            $codigos_jefes[$jefe->codigo] = $jefe->user->nombre;
        }

        return response()->json(['jefes' => $codigos_jefes, 'message' => 'Petición válida', 'rol' => $user->rol], 200);
    }
}
