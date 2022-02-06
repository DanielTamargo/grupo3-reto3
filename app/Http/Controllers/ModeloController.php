<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ModeloController extends Controller
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
    public function store(Request $request, $id)
    {
        //Comprobamos que el cliente nos ha subido un archivo
        if($request->hasFile('manual')){
            //cogemos el archivo y comprobamos si es un PDF 
            $archivo = $request->file('manual');
           
            if($archivo->guessExtension() == 'pdf'){
                //Guardamos el archivo
                $manual = $archivo->getClientOriginalName();
                $archivo2 = public_path('modelos/'.$manual);
                copy($archivo,$archivo2);
                
                //Subimos los cambios a la base de datos
                $modelo = Modelo::find($id);
                $modelo->manual= $manual;
                $modelo->save();
                
            }
           
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = Modelo::find($id);
        return view('modelos.show')->with('modelo',$modelo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelo $modelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelo $modelo)
    {
        //
    }
}
