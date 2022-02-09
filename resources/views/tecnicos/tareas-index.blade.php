@extends('layouts.app')

@section('title')
    Igobide | Tareas
@endsection

@section('content')
<div class="col-12">
    <h3>Lista de tareas del técnico {{ $tecnico->user->nombre }} {{ $tecnico->user->apellidos }}</h3>
    <table class="border table table-hover rounded empleados">
        <thead>
            <tr class="table-primary">
                <th scope="col">Codigo</th>
                <th scope="col">Fecha Inico</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Tipo</th>
                <th scope="col">Referencia Ascensor</th>
                <th scope="col">T&eacute;cnico</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody class="tareas">
            @foreach ($tareas as $tarea)
                <tr>
                    <th scope="col">{{ $tarea->id }}</th>
                    <td>{{ $tarea->fecha_creacion }}</td>
                    @if ($tarea->fecha_finalizacion)
                        <td>{{ $tarea->fecha_finalizacion }}</td>
                    @else
                        <td>Sin finalizar</td>
                    @endif
                    @switch($tarea->tipo)
                        @case('incidencia')
                        <td>Incidencia</td>      
                            @break
                        @case('revision')
                            <td>Revisión</td>
                            @break
                        @default
                            <td>Avería</td>
                    @endswitch
                    <td>{{ $tarea->ascensor_ref }}</td>
                    <td>{{ $tarea->tecnico_codigo }}</td>
                    @switch($tarea->estado)
                        @case('sintratar')
                        <td>Sin tratar</td>      
                            @break
                        @case('imposiblesolucionar')
                            <td>Sin solución</td>
                            @break
                        @case('materialnecesario')
                            <td>Sin material</td>
                            @break
                        @case('retrasado')
                            <td>Retrasado</td>
                            @break
                        @default
                            <td>Finalizado</td>
                    @endswitch
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
