<?php

namespace App\Http\Controllers;

use App\Models\Parte;
use App\Models\Tarea;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class ParteController extends Controller
{
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

        $fecha_parte = new DateTime();
        $fecha_parte->setTimestamp(time());

        $tarea = Tarea::find($request->idtarea);
        $tarea->estado = $request->estado;
        $tarea->tipo = $request->tipo;
        $tarea->fecha_finalizacion = $fecha_parte;
        $tarea->save();

        // Notificamos al cliente
        $detalles = [
            "rol_destinatario" => "nuevo-parte",
            "asunto" => "Actualización incidencia",
            "estado" => $request->estado,
            "nombre" => $tarea->cliente->nombre
        ];
        // Utilizamos siempre esta dirección porque es una aplicación piloto, realmente utilizaríamos $cliente->email
        Mail::to('daniel.tamargo@ikasle.egibide.org')->send(new \App\Mail\GmailManager($detalles));

        return redirect("/tecnico/tareas");
    }
}
