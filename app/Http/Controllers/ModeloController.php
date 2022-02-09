<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeloController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Contemplamos permisos
        $user = Auth::user();
        if (!$user || ($user->rol != "administrador" && $user->rol != "jefeequipo")) return back();

        //Comprobamos que el cliente nos ha subido un archivo
        if($request->hasFile('manual')){
            //cogemos el archivo y comprobamos si es un PDF 
            $archivo = $request->file('manual');
           
            if($archivo->guessExtension() == 'pdf'){
                $modelo = Modelo::find($id);

                //Guardamos el archivo
                $manual = $request->modelo_id . "-" . time() . "-" . $modelo->nombre . ".pdf";
                $ruta = public_path('modelos/' . $manual);
                copy($archivo, $ruta);
                
                //Subimos los cambios a la base de datos
                $modelo->manual= $manual;
                $modelo->save();
                return redirect('/modelos/' . $request->modelo_id)->with('exito','Documento subido correctamente');
            }
            else{
                return back()->with('error','El documento tiene que ser PDF');
            }      
        }
        else{
            return back()->with('error','Tienes que añadir un manual');
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

}
