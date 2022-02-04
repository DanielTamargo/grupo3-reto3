<?php

namespace App\Http\Controllers;

use App\Models\Operador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperadorController extends Controller
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

    public function nuevaTarea() {
        $user = Auth::user();
        if (!$user) return view('errors.404');

        if ($user->rol == "administrador") 
            return view('operadores.nuevaAveria')->with('seleccionar_ascensor', true)->with('operadores', \App\Models\Operador::all());

        
        return view('operadores.nuevaAveria')->with('seleccionar_ascensor', true);
    }
    public function crearParte(){
        return view('operadores.nuevoParte');
    }
    public function mostrarUltimasRevisiones(){
        return view('operadores.ultimasRevisiones');
    }
    public function asignarRevisiones(){
        return view('operadores.nuevaRevision');
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
     * @param  \App\Models\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function show(Operador $operador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function edit(Operador $operador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operador $operador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operador $operador)
    {
        //
    }
}
