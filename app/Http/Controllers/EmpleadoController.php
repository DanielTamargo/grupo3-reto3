<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\EmpleadosExport;
use Illuminate\Support\Facades\Hash;
use Excel;

class EmpleadoController extends Controller
{
    /**
     * Edita el empleado.
     * En la petición recibiremos el id de usuario a modificar y la nueva contraseña
     * Si el empleado no existe, devolverá error 404
     * Si el usuario navegador no tiene permisos para ver el perfil, devolverá error 403
     *
     * Si la contraseña es menor de 8 caracteres, volverá a la vista anterior notificando el error
     *      también si es mayor de 150 caracteres (por poner un límite)
     */
    public function editarEmpleado(Request $request) {
        $user = Auth::user();
        if (!$user) return view('errors.403'); //<- no loggeado

        if ($user->rol != "administrador" && $user->id != $request->user_id) return view('errors.403'); //<- sin permisos

        $user = User::find($request->user_id); //<- obtener usuario consultado
        if (!$user) return view('errors.404'); //<- empleado no existe

        if (strlen($request->password) < 8 || strlen($request->password) > 150) { // 150 por contemplar una contraseña extra-mega-ultra-segura que quizás supondría demasiado, quizás
            if (strlen($request->password) > 150) return back()->with('error', '¡Tranquilo! La contraseña debe tener un máximo de 150 caracteres');
            else return back()->with('error', 'La contraseña debe tener mínimo 8 caracteres');
        }

        $user->password = Hash::make($request->password); // <- la guardamos encriptada
        $user->save();

        return back()->with('exito', 'La contraseña ha sido modificada con éxito');
    }

    /**
     * Muestra los datos de un empleado (show)
     * Si el empleado no existe, devolverá error 404
     * Si el usuario navegador no tiene permisos para ver el perfil, devolverá error 403
     * @param number $user_id id del usuario
     */
    public function mostrarEmpleado($user_id) {
        $user = Auth::user();
        if (!$user) return view('errors.403'); //<- no loggeado

        $empleado = User::find($user_id);
        if (!$empleado) return view ('errors.404'); //<- no existe

        // Sólo podrán ver el perfil el propio usuario, un administrador o un jefe de equipo a sus técnicos
        if ($user->rol != "administrador" && $user->id != $user_id &&
                !($user->rol == "jefeequipo" && $empleado->rol == "tecnico" && $user->puesto->codigo == $empleado->puesto->jefe_codigo)) {
                    return view('errors.403'); //<- sin permisos // TODO dani: probar
        }

        // Si lo está consultando un técnico cargaremos una vista distinta, respetando el layout del que hereda
        if ($user->rol == "tecnico") return view('empleados.show-pov-tecnico')->with('user', $empleado);

        return view('empleados.show')->with('user', $empleado);
    }

    /**
     * Muestra un listado de los empleados registrados
     * El administrador verá todos los empleados, el jefe de equipo verá sólo sus técnicos
     *
     * Si el usuario navegador no tiene permisos para ver el perfil, devolverá error 403
     */
    public function listarEmpleados(Request $request)
    {
        $user = Auth::user();

        if (!$user) return redirect()->route('login'); //<- no loggeado
        if ($user->rol != "administrador" && $user->rol != "jefeequipo") return view('errors.403'); //<- sin permisos

        $usuarios = [];
        if ($user->rol == "administrador") $usuarios = User::where('id', '>', 0)->orderBy('id', 'desc')->get();
        if ($user->rol == "jefeequipo") {
            $usuarios_tecnicos = User::where('rol', 'tecnico')->orderBy('id', 'desc')->get();
            foreach($usuarios_tecnicos as $tecnico) {
                if ($tecnico->puesto->jefe_codigo == $user->puesto->codigo) array_push($usuarios, $tecnico);
            }
        }

        return view('empleados.index')->with('usuarios', $usuarios);
    }


    /**
     * Obtiene un listado de empleados y lo exporta a Excel
     *
     * Solo podrán ejecutarlo administradores y jefes de equipo
     * Si no tiene permisos simplemente volverá
     *
     * El nombre del fichero será empleados-fecha.xlsx
     * La fecha tendrá el formato YYYY-MM-DD
     */
    public function exportarExcel()
    {
        $data = $this->obtenerEmpleados();

        $nombre = "empleados-" . date('Y-m-d') . ".xlsx";
        return Excel::download(new EmpleadosExport($data), $nombre);
    }

    /**
     * Obtiene un listado de empleados y lo exporta a CSV
     *
     * Solo podrán ejecutarlo administradores y jefes de equipo
     * Si no tiene permisos simplemente volverá
     *
     * El nombre del fichero será empleados-fecha.csv
     * La fecha tendrá el formato YYYY-MM-DD
     */
    public function exportarCSV() {
        $data = $this->obtenerEmpleados();

        $nombre = "empleados-" . date('Y-m-d') . ".csv";
        return Excel::download(new EmpleadosExport($data), $nombre);
    }

    /**
     * Obtiene un listado de empleados y devuelve los siguientes datos en un array asociativo:
     * id, nombre, apellidos, email, dni, rol, codigo
     *
     * Si el usuario loggeado es administrador obtendrá todos los empleados, si es jefe de equipo
     * obtendrá sólo los empleados de su equipo
     *
     * Si no está loggeado o no tiene permisos, volverá atrás sin ejecutar ninguna descarga
     */
    public function obtenerEmpleados() {
        $user = Auth::user();
        if (!$user || ($user->rol != "administrador" && $user->rol != "jefeequipo")) return back();

        $empleados = [];
        if ($user->rol == "jefeequipo") {
            $empleados = User::where('rol', 'tecnico')->get();
            $empleados_aux = [];

            foreach($empleados as $empleado) {
                if ($empleado->rol == "tecnico" && $empleado->puesto->jefe_codigo == $user->puesto->codigo) {
                    array_push($empleados_aux, $empleado);
                }
            }

            $empleados = $empleados_aux;
        } else if ($user->rol == "administrador") {
            $empleados = User::all();
        } else {
            return back();
        }

        $data = [];
        foreach($empleados as $empleado) {
            $emp = [];
            $emp["id"] = $empleado->id;
            $emp["nombre"] = $empleado->nombre;
            $emp["apellidos"] = $empleado->apellidos;
            $emp["email"] = $empleado->email;
            $emp["dni"] = $empleado->dni;
            $emp["rol"] = $empleado->rol;
            $emp["codigo"] = $empleado->puesto->codigo;

            array_push($data, $emp);
        }

        return $data;
    }


    /**
     * Elimina el empleado indicado
     * Solo podrán ejecutarlo administradores y jefes de equipo
     * Si no tiene permisos mostrará error 403
     * Si el empleado a eliminar no existe devolverá error 404
     */
    public function eliminarEmpleado(Request $request) {
        $user = Auth::user();
        if (!$user) return view('errors.403'); // <- usuario registrado

        if ($user->rol != "administrador" && $user->rol != "jefeequipo") return view('errors.403'); // <- sin privilegios

        $empleado = User::find($request->id);
        if (!$empleado) return view('errors.404'); // <- no existe
        $empleado->delete();

        return back()->with('usuario_eliminado', true);
    }


}
