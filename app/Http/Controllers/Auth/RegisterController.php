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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME; // <- No hay necesidad de cambiarlo, nos viene perfecto!

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:20'],
            'dni' => ['required', 'string', 'max:9'],
            'rol' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // <- ¡Se construirá solo con nombre y apellido!
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'jefe_codigo' => ['optional', 'string', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Registramos dos entidades, el usuario y su entidad puesto relacionada

        // Usuario
        $user = User::create([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'telefono' => $data['telefono'],
            'dni' => $data['dni'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // <- encripteision!
        ]);

        // Entidad puesto
        // Dependiendo del rol crearemos un registro de una u otra entidad
        switch($data['rol']) {
            case Roles::OPERADOR: {
                Operador::create([
                    'user_id' => $user->id,
                    'codigo' => 'op_' . str_pad($user->id, 5, "0", STR_PAD_LEFT)
                ]);
                break;
            }
            case Roles::TECNICO: {
                Tecnico::create([
                    'user_id' => $user->id,
                    'codigo' => 'tec_' . str_pad($user->id, 5, "0", STR_PAD_LEFT),
                    'jefe_codigo' => $data['jefe_codigo']
                ]);
                break;
            }
            case Roles::JEFEEQUIPO: {
                JefeEquipo::create([
                    'user_id' => $user->id,
                    'codigo' => 'jef_' . str_pad($user->id, 5, "0", STR_PAD_LEFT)
                ]);
                break;
            }
            case Roles::ADMINISTRADOR: {
                Administrador::create([
                    'user_id' => $user->id,
                    'codigo' => 'adm_' . str_pad($user->id, 5, "0", STR_PAD_LEFT)
                ]);
                break;
            }
        }

        return $user;
    }
}
