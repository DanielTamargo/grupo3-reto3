<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Support\Facades\Auth;

class CredencialesController extends Controller
{
    /**
     * Comprueba que el usuario dispone del nivel de permisos necesario para ejecutar la petición.
     * Comprobará:
     * - Que el usuario está loggeado
     * - Que el usuario tiene un rol que esté presente en el array roles_admitidos
     * - Si la petición es api devolverá una respuesta json, si no lo es devolverá la vista indicada
     * 
     * @param array<string> roles_admitidos array de strings, cada valor será el rol admitido a cotejar con el rol del usuario.
     * @param bool api variable boolean que indicará si se trata de una api o una petición web
     * @param bool roles_especificos variable boolean que indicará si debe comprobar si el rol del usuario tiene permisos necesarios
     */
    public static function comprobarPermisos($roles_admitidos=["administrador"], $api=false, $roles_especificos=true)
    {
        // Actuaremos distinto si es una api o no

        // Comprobamos que está loggeado 
        $user = Auth::user();
        if (!$user) {
            if ($api) { // Petición API
                return response()->json([
                    'ok' => false,
                    'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                    'rol' =>  'invitado'
                ]);
            } else {
                return redirect()->route('login'); // <- (con el middleware ya debería estar contemplado)
            }
        }

        // Cotejamos la lista de permisos
        if ($roles_especificos && !array_key_exists($user->rol, $roles_admitidos)) {
            if ($api) { // Petición API
                return response()->json([
                    'ok' => false,
                    'message' => 'No dispones de los suficientes permisos para solicitar estos datos',
                    'rol' =>  $user->rol,
                ]);
            } else {
                return view('errors.403'); // <- (con el middleware ya debería estar contemplado)
            }
        }
    }
}
