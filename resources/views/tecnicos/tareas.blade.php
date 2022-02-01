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
        <!-- despues blade generara los item de esta lista.

        posible que las tareas tengan un codigo de color dependiendo de 
        su prioridad / que aparezcan primero-->
        @if ($tareas != null)
            @for ($x = 0; $x < count($tareas); $x++)
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading{{ $x }}">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $x }}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $x }}">
                    <span class="me-4 bg-info rounded-pill">
                            prioridad: {{ $tareas[$x]->prioridad }};
                    </span>

                    id: {{ $tareas[$x]->id }}
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse{{ $x }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{ $x }}">
                    <div class="accordion-body">
                    {{ $tareas[$x]->anotacion }}
                        <p><b>Fecha reportado: </b>{{ $tareas[$x]->fecha_creacion }}</p>
                        <p><b>REF: </b>{{ $tareas[$x]->ascensor_ref }}</p>
                        <p><b>Tipo: </b>{{ $tareas[$x]->tipo }}</p>
                        <p><b>Descripcion: </b><br>{{ $tareas[$x]->descripcion }}</p>
                        
                        
                    </div>
                </div>
            </div>
            @endfor
        @else
        <p>de momento no hay averias</p>
        @endif
    </div>
@endsection