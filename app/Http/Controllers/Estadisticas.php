<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class Estadisticas extends Controller
{
    /**
     * Muestra la vista de estadísticas
     *
     * Si no es un jefe de equipo o un administrador volverá a inicio
     * 
     * Esta vista solicitará datos mediante peticiones Ajax a la API
     */
    public function mostrar() {
        if(Auth::user()->rol == 'administrador' || Auth::user()->rol == 'jefeequipo'){
             return view('estadisticas');
        } else {
            return redirect()->route('inicio');
        }
       
    }
}
