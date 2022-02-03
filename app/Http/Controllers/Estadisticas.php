<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ascensor;
use App\Models\Tecnico;
use App\Models\Tarea;

class Estadisticas extends Controller
{
    public function mostrar(Request $request) {
        // TODO validar que el usuario tiene permisos (admin y jefeequipo)

        return view('estadisticas');
    }
}
