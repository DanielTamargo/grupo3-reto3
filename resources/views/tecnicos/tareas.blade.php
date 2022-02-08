<?php /*
    vista de las tareas que va a tener el tecnico
*/?>
@extends('layouts.tecnico')

@section('title')
Tareas
@endsection

@section('content')
    <p class="display-5">Tareas pendientes</p>
    <div class="accordion">
        <!-- despues blade generara los item de esta lista.-->
        @if (count($tareas) != 0)
            @for ($x = 0; $x < count($tareas); $x++)
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading{{ $x }}">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $x }}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $x }}">
                    <span class="me-4 rounded-pill px-1
                    @switch ($tareas[$x]->prioridad)
                    @case (5) bg-prioridad5 @break
                    @case (4) bg-prioridad4 @break
                    @case (3) bg-prioridad3 @break
                    @case (2) bg-prioridad2 @break
                    @case (1) bg-prioridad1 @break
                    @default bg-gris3 @break
                    @endswitch">
                            prioridad: {{ $tareas[$x]->prioridad }}
                    </span>

                    id: {{ $tareas[$x]->id }}
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse{{ $x }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{ $x }}">
                    <div class="accordion-body">
                        <p><b>Fecha reportado: </b>{{ $tareas[$x]->fecha_creacion }}</p>
                        <p><b>REF: </b>{{ $tareas[$x]->ascensor_ref }}</p>
                        <p><b>Tipo: </b>{{ $tareas[$x]->tipo }}</p>
                        <p><b>Descripcion: </b><br>{{ $tareas[$x]->descripcion }}</p>
                        
                        <a href="{{ route('tecnico.create', ['idtarea' => $tareas[$x]->id]) }}" class="btn btn-outline-light">Crear parte</a>
                    </div>
                </div>
            </div>
            @endfor
        @else
        <p>de momento no hay averias</p>
        @endif
    </div>
@endsection