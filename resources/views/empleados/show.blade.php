@extends('layouts.app')
@section('content')
    <div class="col-12 h-75 d-flex flex-column align-items-center">
        <style>
            h3, h4 {
                margin-top: 1em;
            }
            .form-personal.no-edit {
                min-width: 350px;
                margin-bottom: 5px
            }
            @media (max-width: 360px) {
                .form-personal.no-edit {
                    min-width: 95vw;
                } 
            }
        </style>

        <div class="row">
            <div class="col-12">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @elseif(session()->has('exito'))
                    <div class="alert alert-success">
                        {{ session()->get('exito') }}
                    </div>
                @endif
                <h3>Datos empleado</h3>
                <p id="nombre" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">{{ $user->nombre }} {{ $user->apellidos }}</p>
                <p id="email" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Email: {{ $user->email}}</p>
                <p id="dni" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">DNI: {{ $user->dni}}</p>
                <p id="telefono" aria-disabled="true"  class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Teléfono: {{ $user->telefono}}</p>
                <p id="registrado-el" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Registrado el: {{ $user->created_at }}</p>
                <h3>Información puesto</h3>
                @if ($user->rol == "operador")
                    <p id="puesto" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Puesto: Operador</p>
                    <p id="num_tareas" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Tareas registradas: {{ count($user->puesto->tareas) }}</p>
                    <p id="num_urgencias" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Urgencias registradas: {{ count(array_filter($user->puesto->tareas->toArray(), function($tar) { return $tar["prioridad"] == 5; })) }}</p>
                @elseif ($user->rol == "tecnico")
                    <p id="puesto" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Puesto: Técnico</p>
                    <p id="num-tareas-totales" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Tareas totales asignadas: {{ count($user->puesto->tareas) }}</p>
                    <p id="num-urgencias-totales" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Urgencias totales asignadas: {{ count(array_filter($user->puesto->tareas->toArray(), function($tar) { return $tar["prioridad"] == 5; })) }}</p>
                    <p id="num-tareas-resueltas" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Tareas resueltas:  {{ count(array_filter($user->puesto->tareas->toArray(), function($tar) { return $tar["estado"] == "finalizado"; })); }}</p>
                    <p id="num-pendientes" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Tareas pendientes:  {{ count(array_filter($user->puesto->tareas->toArray(), function($tar) { return $tar["estado"] != "finalizado" && $tar["estado"] != "imposiblesolucionar"; })); }}</p>
                @elseif ($user->rol == "jefeequipo")
                    <p id="puesto" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Puesto: Jefe de Equipo</p>
                    <p id="num_empleados" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Técnicos asignados: {{ count($user->puesto->tecnicos) }}</p>

                @elseif ($user->rol == "administrador")
                    <p id="puesto" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Puesto: Administrador</p>
                    <p id="num-empleados" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Empleados registrados: {{ count(\App\Models\User::all()) }}</p>
                    <p id="num-empleados" aria-disabled="true" class="user-select-none form-personal no-edit bg-dark rounded-pill text-black">Tareas registradas: {{ count(\App\Models\Tarea::all()) }}</p>
                    
                @endif
                @if (Auth::user()->id == $user->id || Auth::user()->rol == "administrador")
                    <form action="{{ route('empleados.edit', ["user_id" => $user->id]) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <h4 class="text-center">Modificar contraseña</h4> 
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input required type="text" name="password" id="password" placeholder="Nueva contraseña..." class="mt-2 form-control bg-dark rounded-pill text-black" />
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center"> 
                                <button type="submit" class=" mt-2 btn btn-outline-light text-black">Actualizar</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection