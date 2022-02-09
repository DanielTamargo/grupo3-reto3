<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class Estadisticas extends Controller
{
    public function mostrar() {
        if(Auth::user()->rol == 'administrador' || Auth::user()->rol == 'jefeequipo'){
             return view('estadisticas');
        } else {
            return redirect('home');
        }
       
    }
}
