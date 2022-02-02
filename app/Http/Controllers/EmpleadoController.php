<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
{
    public function listarEmpleados(Request $request)
    {
        $user = Auth::user();

        if (!$user) return redirect()->route('login');
        if ($user->rol != "administrador" && $user->rol != "jefeequipo") return view('errors.403');

        $usuarios = [];
        if ($user->rol == "administrador") $usuarios = User::all();
        if ($user->rol == "jefeequipo") {
            $usuarios_tecnicos = User::where('rol', 'tecnico')->get();
            foreach($usuarios_tecnicos as $tecnico) {
                if ($tecnico->puesto->jefe_codigo == $user->puesto->codigo) array_push($usuarios, $tecnico);
            }
        }
        


        return view('empleados.index')->with('usuarios', $usuarios);
    }
}
