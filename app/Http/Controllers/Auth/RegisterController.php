<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\Enums\Roles;
use App\Models\JefeEquipo;
use App\Models\Operador;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Tecnico;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    /**
     * Muestra la vista para crear un nuevo usuario empleado
     */
    protected function create() {
        return view('empleados.register');
    }


    /**
     * Crea una instancia de user y su respectiva entidad empleo, dependiendo del rol será un empleo u otro
     */
    protected function store(Request $request)
    {
        // Comprobamos permisos
        $user = Auth::user();
        if (!$user || $user->rol != "administrador" && $user->rol != "operador") return view('errors.403');

        // Validamos los datos
        $old_email = $request->email;
        $request["email"] .= "@igobide.com";
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:12|unique:users',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'rol' => 'required|string|max:255',
            'jefe_codigo' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            $request["email"] = $old_email;
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Registramos dos entidades, el usuario y su entidad puesto relacionada

        // Usuario
        $user = User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'dni' => $request->dni,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make($request->password), // <- ¡encripteision!
        ]);

        // Entidad puesto
        // Dependiendo del rol crearemos un registro de una u otra entidad
        switch($request->rol) {
            case "operador": {
                Operador::create([
                    'user_id' => $user->id,
                    'codigo' => 'op_' . str_pad($user->id, 5, "0", STR_PAD_LEFT)
                ]);
                break;
            }
            case "tecnico": {
                Tecnico::create([
                    'user_id' => $user->id,
                    'codigo' => 'tec_' . str_pad($user->id, 5, "0", STR_PAD_LEFT),
                    'jefe_codigo' => $request->jefe_codigo
                ]);
                break;
            }
            case "jefeequipo": {
                JefeEquipo::create([
                    'user_id' => $user->id,
                    'codigo' => 'jef_' . str_pad($user->id, 5, "0", STR_PAD_LEFT)
                ]);
                break;
            }
            case "administrador": {
                Administrador::create([
                    'user_id' => $user->id,
                    'codigo' => 'adm_' . str_pad($user->id, 5, "0", STR_PAD_LEFT)
                ]);
                break;
            }
        }

        // Enviamos email al empleado con la URL al login y sus credenciales
        $detalles = [
            'asunto' => 'Usuario Registrado',
            'rol_destinatario' => 'nuevo-empleado',
            'nombre' => $request->nombre,
            'usuario' => $old_email,
            'password' => $request->password
        ];

        // Siempre se envían a esta cuenta puesto que es un proyecto piloto
        Mail::to('daniel.tamargo@ikasle.egibide.org')->send(new \App\Mail\GmailManager($detalles));

        return redirect()->route('inicio', ['usuario_creado' => true]);
    }
}
