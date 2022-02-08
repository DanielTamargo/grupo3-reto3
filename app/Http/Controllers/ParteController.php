<?php

namespace App\Http\Controllers;

use App\Models\Parte;
use App\Models\Tarea;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParteController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parte = new Parte();
        


        $parte->tecnico_codigo = Auth::user()->puesto->codigo;
        $parte->tarea_id = $request->idtarea;
        $parte->tarea_estado = $request->estado;
        $parte->tarea_tipo = $request->tipo;
        $parte->anotacion = $request->anotacion;

        $parte->save();

        $tarea = Tarea::find($request->idtarea);
        $tarea->estado = $request->estado;
        $tarea->tipo = $request->tipo;
        $tarea->save();

        return redirect("/tecnico/tareas");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parte  $parte
     * @return \Illuminate\Http\Response
     */
    public function show(Parte $parte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parte  $parte
     * @return \Illuminate\Http\Response
     */
    public function edit(Parte $parte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parte  $parte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parte $parte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parte  $parte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parte $parte)
    {
        //
    }
}
