<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function inicio(Request $request)
    {
        $user = Auth::user();

        // Comprobamos que está loggeado (Con el middleware ya debería estar contemplado)
        if (!$user) return redirect()->route('login');

        // Dependiendo de su rol, cargará una ruta u otra
        if ($user->rol == "operador") return redirect()->route('home.operador');
        if ($user->rol == "tecnico") return redirect()->route('tecnico.home');
        if ($user->rol == "jefeequipo") return redirect()->route('home.jefe', ['usuario_creado' => $request->usuario_creado]);
        if ($user->rol == "administrador") return redirect()->route('administrador.home', ['usuario_creado' => $request->usuario_creado]);
    }
}
