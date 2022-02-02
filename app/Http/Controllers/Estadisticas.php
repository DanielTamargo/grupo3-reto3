<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ascensor;
use App\Models\Tecnico;
use App\Models\Tarea;

class Estadisticas extends Controller
{
    public function mostrar(){
        $datos_tecnicos = Tecnico::all();
        $datos_tareas = Tarea::all();
        $datos_Tecnico = [];
        $datos_Tarea = [];

        foreach ( $datos_tecnicos as $datos_tecnico){
            array_push($datos_Tecnico,['codigo'=>$datos_tecnico['codigo'],'jefe_codigo'=>$datos_tecnico['jefe_codigo']]);
        }
      
        foreach ( $datos_tareas as $datos_tarea){
            array_push($datos_Tarea,['tecnico_codigo'=>$datos_tarea['tecnico_codigo'],'ascensor_ref'=>$datos_tarea['ascensor_ref'],'estado' => $datos_tarea['estado']]);
           
        }

        return view('estadisticas')->with('datos_Tarea',$datos_Tarea)->with('datos_Tecnico',$datos_Tecnico);
    }
}
