<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ascensor;
use App\Models\Tecnico;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class Estadisticas extends Controller
{
    public function mostrar(Request $request) {
        // TODO validar que el usuario tiene permisos (admin y jefeequipo)
        if(Auth::user()->rol == 'administrador' || Auth::user()->rol == 'jefeequipo'){
             return view('estadisticas');
        }
        else{
            return redirect('home');
        }
       
    }
}
