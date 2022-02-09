<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        $tareas = Tarea::where('tecnico_codigo',Auth::user()->puesto->codigo)->where('estado', "!=",'sintratar')->get();

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
            $tareas = Tarea::where('tecnico_codigo',Auth::user()->puesto->codigo)->where('estado', "!=",'sintratar')->where('id',$request->fecha)->get();
        }
        else {
            // valor entre fechas
            $dia = date("Y-m-d",strtotime($request->fecha));
            $diasiguiente = date("Y-m-d",strtotime($request->fecha) + (24 * 60 * 60));

            $tareas = Tarea::where('tecnico_codigo',Auth::user()->puesto->codigo)->where('estado', "!=",'sintratar')->where('fecha_finalizacion','>',$dia)->where('fecha_finalizacion','<',$diasiguiente)->get();
        }

        
        return view('tecnicos.historial',["tareas" => $tareas]);
    }

    /* muestra la vista manual */
    public function showManual() {

        $errorview = $this->validarTecnico(Auth::user());
        if ($errorview != "") {
            return view($errorview);
        }

        return view('tecnicos.manual');
    }
    /* muestra la vista piezas */
    public function piezas() {

        $errorview = $this->validarTecnico(Auth::user());
        if ($errorview != "") {
            return view($errorview);
        }

        return view('tecnicos.piezas');
    }

    /* funcion para validar que el identificador que pasa la ruta viene de un tecnico o un usuario con permiso
        @param  int $codigo  codigo del usuario/tecnico
        @return string  el nombre de la vista de error al que redireccionar la peticion, en caso de validar devuelve un string vacio
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
}
