<?php

/**
 * OLD api controller
 * 
 * El funcional y actualizado está en /http/controllers/api/v1
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function codigosJefesEquipos() {
        $user = Auth::user();
        if ($user == null) {
            return response()->json([
                "exito" => false,
            ]);
        }

        $jefes = \App\Models\JefeEquipo::all();
        $codigos_jefes = [];
        foreach($jefes as $jefe) {
            array_push($codigos_jefes, $jefe->codigo);
        }

        return response()->json([
            "exito" => true,
            "codigos_jefes" => $codigos_jefes
        ]);
    }

}
