<?php

namespace App\Http\Controllers;

use App\Models\JefeEquipo;
use Illuminate\Http\Request;

class JefeEquipoController extends Controller
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
     * @param  \App\Models\JefeEquipo  $jefeEquipo
     * @return \Illuminate\Http\Response
     */
    public function show(JefeEquipo $jefeEquipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JefeEquipo  $jefeEquipo
     * @return \Illuminate\Http\Response
     */
    public function edit(JefeEquipo $jefeEquipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JefeEquipo  $jefeEquipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JefeEquipo $jefeEquipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JefeEquipo  $jefeEquipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(JefeEquipo $jefeEquipo)
    {
        //
    }

    public function estadisticasShow(){
        return view('jefes.estadisticas');
    }

    public function mostrarVistaNuevosUsuarios(){
        return view('jefes.nuevoUsuario');
    }

    public function mostrarVistaBorrarUsuarios(){
        return view('jefes.borrarUsuario');
    }

    public function mostrarVistaModificarUsuarios(){
        return view('jefes.modificarUsuario');
    }

    public function mostrarVistaSubirManuales(){
        return view('jefes.subirManuales');
    }

    public function mostrarVistaHistorial(){
        return view('jefes.subirManuales');
    }
}
