<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    /**
     * Redirige al inicio que dependiendo del rol del usuario loggeado será una ruta u otra 
     * 
     * Si es un usuario no loggeado será redirigido al login
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

    /**
     * Carga la vista de listado de ascensores con todos los ascensores
     * 
     * Cualquier empleado podrá consultar la lista de ascensores
     */
    public function indexAscensores() {
        return view('ascensores.index')->with('ascensores', \App\Models\Ascensor::all());
    }
    /**
     * Carga la vista de listado de modelos con todos los modelos
     * 
     * Cualquier empleado podrá consultar la lista de modelos
     */
    public function indexModelos() {
        return view('modelos.index')->with('modelos', \App\Models\Modelo::all());
    }
}
