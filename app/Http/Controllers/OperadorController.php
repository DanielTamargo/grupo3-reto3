<?php

namespace App\Http\Controllers;

use App\Models\Ascensor;
use App\Models\Cliente;
use App\Models\Operador;
use App\Models\Tarea;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class OperadorController extends Controller
{

    /**
     * Crea y guarda una nueva tarea
     * 
     * Se valida que el email del cliente tenga formato email y que el operador, tecnico y ascensor sean válidos (es decir, que existan)
     * Si no pasa la validación, volverá atrás mostrando el error
     * 
     * Sólo podrá crear una tarea un administrador o un operador, si no, mostrará error 403
     */
    public function crearTarea(Request $request) {
        // Comprobamos permisos
        $user = Auth::user();
        if (!$user || $user->rol != "administrador" && $user->rol != "operador") return view('errors.403');

        // Validamos los datos
        $errors = [];
        $validator = Validator::make($request->all(), [
            'cliente_email' => 'required|string|max:255|email',
        ]);
        if ($validator->fails()) $errors["cliente"] = "El email del cliente no cumple el formato de email";

        $tecnico = Tecnico::find($request->tecnico_codigo);
        $operador = Operador::find($request->operador_codigo);
        $ascensor = Ascensor::find($request->ascensor_num_ref);

        if (!$operador) $errors["operador"] = "Error al asignar el operador";
        if (!$tecnico) $errors["tecnico"] = "Error al asignar el técnico";
        if (!$ascensor) $errors["ascensor"] = "Error al seleccionar el ascensor";

        if (count($errors) > 0) {
            return back()
                    ->withErrors($errors)
                    ->withInput();
        }

        // Si la validación ha pasado, pasamos a comprobar si el cliente ya estaba registrado
        $cliente = Cliente::where('email', $request->cliente_email)->first();
        if (!$cliente) { // Si el cliente no existe, lo creamos
            $cliente = Cliente::create([
                'nombre' => $request->cliente_nombre,
                'email' => $request->cliente_email
            ]);
        } else { // Si el cliente ya existía, actualizamos su nombre
            $cliente->nombre = $request->cliente_nombre;
        }
        $cliente->save();

        // Creamos la tarea
        $tarea = Tarea::create([
            'tipo' => $request->tipo,
            'prioridad' => intval($request->prioridad),
            'ascensor_ref' => $request->ascensor_num_ref,
            'tecnico_codigo' => $request->tecnico_codigo,
            'operador_codigo' => $request->operador_codigo,
            'cliente_id' => $cliente->id,
            'descripcion' => $request->descripcion ? $request->descripcion : '',
        ]);
        $tarea->save();

        // Notificamos al empleado
        $detalles = [
            "prioridad" => intval($request->prioridad),
            "rol_destinatario" => "nueva-tarea-tecnico",
            "asunto" => "Nueva tarea (id: $tarea->id)",
            "tarea_id" => $tarea->id
        ];

        try {
            // Utilizamos siempre esta dirección porque es una aplicación piloto, realmente utilizaríamos $tecnico->user->email
            Mail::to('daniel.tamargo@ikasle.egibide.org')->send(new \App\Mail\GmailManager($detalles));
        } catch(\Exception $e) {
            // Aquí podríamos llevar logs relacionados con los emails...
        }

        // Notificamos al cliente
        $detalles = [
            "rol_destinatario" => "nueva-tarea-cliente",
            "asunto" => "Incidencia registrada",
            "nombre" => $cliente->nombre
        ];

        try {
            // Utilizamos siempre esta dirección porque es una aplicación piloto, realmente utilizaríamos $cliente->email
            Mail::to('daniel.tamargo@ikasle.egibide.org')->send(new \App\Mail\GmailManager($detalles));
        } catch(\Exception $e) {
            // Aquí podríamos llevar logs relacionados con los emails...
        }

        return redirect()->route('tareas.index', ['tarea_creada' => true]);
    }

    /**
     * Carga la vista para generar una nueva tarea
     * Sólo podrán generar tareas administradores y operadores
     */
    public function nuevaTarea() {
        $user = Auth::user();
        if (!$user) return view('errors.404');

        if ($user->rol == "administrador")
            return view('operadores.nuevaTarea')->with('seleccionar_ascensor', true)->with('operadores', Operador::all());


        return view('operadores.nuevaTarea')->with('seleccionar_ascensor', true);
    }


    /**
     * Listar las tareas pendientes
     * Un operador y un administrador podrán ver todas las tareas pendientes
     */
    public function listarTareas(){
        //cogemos todas las tareas y comprobamos sus credenciales
        $tareas = Tarea::all();

        if(Auth::user()->rol != 'tecnico'){
            //si es administrador le paso las 10 primeras tareas
            $tareas = $tareas->where('id','>',0)->where('id','<',11);
        }
        else{
            return view('inicio');
        }
        return view('operadores.lista-tarea')->with('tareas',$tareas);
    }

}
