@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Página de pruebas:</div>
                <div class="card-body">
                    {{-- USUARIOS --}}
                    @if (isset($mostrar_usuarios) && $mostrar_usuarios)
                        <h3>Usuarios @isset($users) ({{ count($users) }}) @endisset</h3>
                        @if (isset($users))
                            @forelse ($users as $user)
                                <p class="mb-0">{{ $user->id }} | {{ $user->email }} | {{ $user->nombre }} {{ $user->apellidos }}
                                @if ($user->puesto)
                                    <b>({{ $user->rol }} | Código: {{ $user->puesto->codigo }})</b>
                                @else
                                    <b>(sin rol)</b>
                                @endif
                                </p>
                            @empty
                                <p>Sin usuarios registrados</p>
                            @endforelse
                        @else
                            <p>La vista no recibe datos de usuarios</p>
                        @endif

                        <hr>
                        <h3>Jefes de equipo @isset($jefesequipos) ({{ count($jefesequipos) }}) @endisset</h3>
                        @if (isset($jefesequipos))
                            @forelse ($jefesequipos as $jefeequipo)
                                <p class="mb-0">Jefe de equipo {{ $jefeequipo->codigo }} |
                                    {{ $jefeequipo->user->nombre }} {{ $jefeequipo->user->apellidos }} |
                                    Número de empleados: {{ count($jefeequipo->tecnicos) }}</p>
                            @empty
                                <p>Sin jefes de equipo registrados</p>
                            @endforelse
                        @else
                            <p>La vista no recibe datos de jefes de equipos</p>
                        @endif

                        <hr>
                        <h3>Técnicos @isset($tecnicos) ({{ count($tecnicos) }}) @endisset</h3>
                        @if (isset($tecnicos))
                            @forelse ($tecnicos as $tecnico)
                                <p class="mb-0">Técnico {{ $tecnico->codigo }} |
                                    {{ $tecnico->user->nombre }} {{ $tecnico->user->apellidos }} |
                                    Jefe: {{ $tecnico->jefe->user->nombre . " " . $tecnico->jefe->user->apellidos }}</p>
                                <p class="mb-0">Número de tareas: {{ count($tecnico->tareas) }} ({{
                                    count(\App\Models\Tarea::where('tecnico_codigo', $tecnico->codigo)->where('estado', \App\Models\Enums\EstadosTareas::SINTRATAR)->get())
                                }} pendientes)</p>
                                <p>Número de partes: {{ count($tecnico->partes) }}</p>
                            @empty
                                <p>Sin técnicos registrados</p>
                            @endforelse
                        @else
                            <p>La vista no recibe datos de técnicos</p>
                        @endif

                        <hr>
                        <h3>Operadores @isset($operadores) ({{ count($operadores) }}) @endisset</h3>
                        @if (isset($operadores))
                            @forelse ($operadores as $operador)
                                <p class="mb-0">Operador {{ $operador->codigo }} | {{ $operador->user->nombre }} {{ $operador->user->apellidos }}</p>
                            @empty
                                <p>Sin operadores registrados</p>
                            @endforelse
                        @else
                            <p>La vista no recibe datos de operadores</p>
                        @endif
                        <hr>
                    @endif

                    {{-- MODELOS ASCENSORES ETC --}}
                    @if (isset($mostrar_modelos) && $mostrar_modelos)
                        <h3>Modelos @isset($modelos) ({{ count($modelos) }}) @endisset</h3>
                        @if (isset($modelos))
                            @forelse ($modelos as $modelo)
                                <p class="mb-0">Modelo: {{ $modelo->nombre }} (id: {{ $modelo->id }})</p>
                                <p class="mb-0">Ascensores del modelo: {{ count($modelo->ascensores) }}</p>
                                <br>
                            @empty
                                <p>Sin modelos registrados</p>
                            @endforelse
                        @else
                            <p>La vista no recibe datos de modelos</p>
                        @endif
                        <hr>

                        <h3>Ascensores @isset($ascensores) ({{ count($ascensores) }}) @endisset</h3>
                        @if (isset($ascensores))
                            @forelse ($ascensores as $ascensor)
                                <p class="mb-0">Ref. Ascensor: {{ $ascensor->num_ref }}</p>
                                <p class="mb-0">Ubicación: {{ $ascensor->ubicacion }}</p>
                                <p class="mb-0">Modelo del ascensor: {{ $ascensor->modelo->nombre }}</p>
                                <p class="mb-0">Número de tareas: {{ count($ascensor->tareas) }} ({{
                                    count(\App\Models\Tarea::where('ascensor_ref', $ascensor->num_ref)->where('estado', \App\Models\Enums\EstadosTareas::SINTRATAR)->get())
                                    /*count($ascensor->tareas->where('tipo', \App\Models\Enums\EstadosTareas::FINALIZADO))*/
                                }} pendientes)</p>
                                @php // Calculamos los partes totales (porque sí)
                                    $num_partes = 0;
                                    foreach($ascensor->tareas as $t) {
                                        $num_partes += count($t->partes);
                                    }
                                @endphp
                                <p class="mb-0">Número de partes totales: {{ $num_partes }}</p>
                                <br>
                            @empty
                                <p>Sin ascensores registrados</p>
                            @endforelse
                        @else
                            <p>La vista no recibe datos de ascensores</p>
                        @endif
                        <hr>

                    @endif

                    {{-- COPY PASTE IF ISSET ELSE --}}
                    @if (isset($variable))
                    @else
                    @endif
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection
