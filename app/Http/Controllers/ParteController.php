<?php

namespace App\Http\Controllers;

use App\Models\Parte;
use App\Models\Tarea;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ParteController extends Controller
{
    /**
     * Crea y guarda un nuevo parte
     *
     * También actualiza la tarea en base a la información del parte (estado, tipo, fecha finalización...) y si es una revisión
     *      actualizará la fecha_ultima_revision
     *
     * Sólo podrá generar partes un técnico
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->rol != "tecnico") return view('errors.403');

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

        // Si ha sido una revisión se actualiza la fecha de la última revisión del ascensor de la tarea
        // if ($request->tipo == "revision") {
        //     $tarea->ascensor->fecha_ultima_revision = $fecha_parte;
        //     $tarea->ascensor->save(); // TODO dani: probar
        // }

        $tarea->save();

        // Notificamos al cliente
        $detalles = [
            "rol_destinatario" => "nuevo-parte",
            "asunto" => "Actualización incidencia",
            "estado" => $request->estado,
            "nombre" => $tarea->cliente->nombre
        ];
        // Utilizamos siempre esta dirección porque es una aplicación piloto, realmente utilizaríamos $cliente->email
        try {
            Mail::to('daniel.tamargo@ikasle.egibide.org')->send(new \App\Mail\GmailManager($detalles));
        } catch (\Exception $e) {
            // Aquí podríamos guardar en logs el error relacionado con el mail...
        }

        return redirect()->route('tecnico.show'); // TODO dani: probar
    }
}
