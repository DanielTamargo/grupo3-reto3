<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Tarea;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{

    /* obtiene y muestra su historial de tareas para que lo revisen jefes de equipo y administradores */
    public function listarTareas(Request $request) {
        $user = Auth::user();
        if (!$user) return view('errors.403');        

        if ($user->rol != "administrador" && $user->rol != "jefeequipo" && $user->rol != "operador") return view('errors.403');

        $tecnico = Tecnico::find($request->tecnico_codigo);
        if (!$tecnico) return view('errors.404');

        return view('tecnicos.tareas-index')
            ->with('tareas', Tarea::where('tecnico_codigo', $request->tecnico_codigo)
                                ->orderBy('id', 'desc')
                                ->get())
            ->with('tecnico', $tecnico);
    }

    /* muestra la vista nuevaParte */
    public function nuevaParte($idtarea) {
        $errorview = $this->validarTecnico(Auth::user());
        if ($errorview != "") {
            return view($errorview);
        }

        $tarea = Tarea::find($idtarea);

        return view('tecnicos.nuevaParte', ["tarea" => $tarea]);
    }

    /* muestra la vista tareas */
    public function showTareas() {
        
        $errorview = $this->validarTecnico(Auth::user());
        if ($errorview != "") {
            return view($errorview);
         }

        $tareas = Tarea::where('tecnico_codigo',Auth::user()->puesto->codigo)->where('estado', "!=",'finalizado')->orderBy('prioridad','desc')->get();//;
        
        return view('tecnicos.tareas' , ["tareas" => $tareas]);
    }

    /* muestra la vista historial */
    public function showHistorialDefault() {

        $errorview = $this->validarTecnico(Auth::user());
        if ($errorview != "") {
            return view($errorview);
        }
        $tareas = Tarea::where('tecnico_codigo',Auth::user()->puesto->codigo)
                ->where('estado', "!=",'sintratar')
                ->orderBy('fecha_finalizacion','desc')
                ->get();

        return view('tecnicos.historial', ["tareas" => $tareas]);
    }

    /* 
    * funcion que se encarga de hacer busquedas en historial
    * muestra la vista historial 
    */
    public function showHistorial(Request $request) {

        $errorview = $this->validarTecnico(Auth::user());
        if ($errorview != "") {
            return view($errorview);
        }

        if ($request->boolean('idOpt')) {
            // comprueba que la tarea es del tecnico correspondiente
            $tareas = Tarea::where('tecnico_codigo',Auth::user()->puesto->codigo)
                    ->where('estado', "!=",'sintratar')
                    ->where('id',$request->fecha)
                    ->orderBy('fecha_finalizacion','desc')
                    ->get();
        }
        else {
            // valor entre fechas
            $dia = date("Y-m-d",strtotime($request->fecha));
            $diasiguiente = date("Y-m-d",strtotime($request->fecha) + (24 * 60 * 60));

            $tareas = Tarea::where('tecnico_codigo',Auth::user()->puesto->codigo)
                    ->where('estado', "!=",'sintratar')
                    ->where('fecha_finalizacion','>',$dia)
                    ->where('fecha_finalizacion','<',$diasiguiente)
                    ->orderBy('fecha_finalizacion','desc')
                    ->get();
        }

        
        return view('tecnicos.historial',["tareas" => $tareas]);
    }

    /* muestra la vista manual */
    public function showManual() {

        $errorview = $this->validarTecnico(Auth::user());
        if ($errorview != "") {
            return view($errorview);
        }

        $modelos = Modelo::all();
        $listaManual = [];
        foreach ($modelos as $modelo) {
            array_push($listaManual, $modelo->manual);
        }

        return view('tecnicos.manual', ["manuales" => $listaManual]);
    }
    /* muestra la vista piezas */
    public function piezas() {

        $errorview = $this->validarTecnico(Auth::user());
        if ($errorview != "") {
            return view($errorview);
        }

        return view('tecnicos.piezas');
    }

    /**  funcion para validar que el identificador que pasa la ruta viene de un tecnico o un usuario con permiso
    *    @param  int $codigo  codigo del usuario/tecnico
    *    @return string  el nombre de la vista de error al que redireccionar la peticion, en caso de validar devuelve un string vacio
    */
    private function validarTecnico($user) {
        // VALIDACIONES
        // El middleware auth contemplará que el usuario deba estar loggeado

        // Validar que el usuario esté autenticado código se reciba correctamente
        if (!$user) return 'errors.403';

        // Validar que el usuario tiene permisos para ver la página
        // Si el usuario es el propio técnico, o un administrador, o su jefe de equipo, podrá ver la página
        if ($user->rol != "administrador" && $user->rol != "jefeequipo" && $user->rol != "tecnico") {
            return 'errors.403';
        }
        return "";
    }

    /**
     * funcion que recibe lo introducido en el formulario de piezas, como el pedir piezas no tiene 
     * destino a donde enviar datos esta funcion devuelve que los datos han sido enviados correctamente
     */
    public function formPiezas(Request $request) {
        // aqui la funcion qui envia la informacion al departamento correspondiente
        // 

        return back()->with("success", true);
    }
}
