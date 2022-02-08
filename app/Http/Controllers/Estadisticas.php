<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ascensor;
use App\Models\Tecnico;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;

class Estadisticas extends Controller
{
    public function mostrar(Request $request) {
        // Comprobamos que el usuario es administrador o jefe de equipo y si es le llevamos a la vista y sino
        // le llevamos al home
        if(Auth::user()->rol == 'administrador' || Auth::user()->rol == 'jefeequipo'){
            return view('estadisticas');
        }
        else{
            return view('home');
        }
        
    }
}
