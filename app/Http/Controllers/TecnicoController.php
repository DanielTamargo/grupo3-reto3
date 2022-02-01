<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TareaController as ControllersTareaController;
use App\Models\Tecnico;
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
    public function nuevaParte($codigo ) {

        $errorview = $this->validarTecnico($codigo);
        if ($errorview != "") {
            return view($errorview);
        }

        return view('tecnicos.nuevaParte', ["codUsr" => $codigo]);
    }

    /* muestra la vista tareas */
    public function showTareas($codigo ) {
        
        $errorview = $this->validarTecnico($codigo);
        if ($errorview != "") {
            return view($errorview);
        }

        $tec = Tecnico::find($codigo);
        
        $tareas = $tec->tareas;
        //return $tareas[0];
        return view('tecnicos.tareas' , ["codUsr" => $codigo, "tareas" => $tareas]);
    }

    /* muestra la vista historial */
    public function showHistorial($codigo ) {

        $errorview = $this->validarTecnico($codigo);
        if ($errorview != "") {
            return view($errorview);
        }

        return view('tecnicos.historial', ["codUsr" => $codigo]);
    }
    /* muestra la vista manual */
    public function showManual($codigo ) {

        $errorview = $this->validarTecnico($codigo);
        if ($errorview != "") {
            return view($errorview);
        }

        return view('tecnicos.manual', ["codUsr" => $codigo]);
    }
    /* muestra la vista piezas */
    public function piezas($codigo ) {

        $errorview = $this->validarTecnico($codigo);
        if ($errorview != "") {
            return view($errorview);
        }

        return view('tecnicos.piezas', ["codUsr" => $codigo]);
    }

    /* funcion para validar que el identificador que pasa la ruta viene de un tecnico o un usuario con permiso
        @param  int $codigo  codigo del usuario/tecnico
        @return string  el nombre de la vista de error al que redireccionar la peticion, en caso de validar devuelve un string vacio
    */
    private function validarTecnico($codigo) {
        // VALIDACIONES
        // El middleware auth contemplará que el usuario deba estar loggeado

        // Validar que el usuario esté autenticado código se reciba correctamente
        if (!$codigo) return 'errors.403';

        // Validar que el técnico exista (devuelve null si no existe)
        $tecnico = \App\Models\Tecnico::find($codigo);
        if ($tecnico == null) return 'errors.404';

        // Validar que el usuario tiene permisos para ver la página
        // Si el usuario es el propio técnico, o un administrador, o su jefe de equipo, podrá ver la página
        $user = Auth::user();
        if ($user->puesto->codigo != $codigo && $user->rol != "administrador" 
                && ($user->puesto != "jefeequipo" && $user->puesto->codigo != $tecnico->jefe_codigo)) {
            return 'errors.403';
        }
        return "";
    }
}
