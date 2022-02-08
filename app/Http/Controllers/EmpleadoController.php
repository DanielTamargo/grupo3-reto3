<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\EmpleadosExport;
use Excel;

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


    /**
     * Obtiene un listado de empleados y lo exporta a Excel
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
        if (!$user) return back();

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

}
