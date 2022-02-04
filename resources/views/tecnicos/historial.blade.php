<?php /*
    vista del historial de tareas que ha realizado el tecnico
*/?>
@extends('layouts.tecnico')

@section('title')
Historial
@endsection

@section('content')
    <p class="display-4">Historial</p>
    <form action="">
        <div class="input-group mb-3">
            <input type="text" name="" class="form-control rounded-pill bg-dark text-white" placeholder="buscar">
            <button class="btn btn-outline-light rounded-pill bg-dark text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
        <div class="form-check rounded-pill bg-dark text-white">
            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
            buscar por fecha
            </label>
        </div>
    </form>

    

    <div class="accordion">
        <!-- blade generara los item de esta lista-->
        @if ($tareas != null)
            @for ($x = 0; $x < count($tareas); $x++)
        
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-heading{{ $x }}">
                        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $x }}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $x }}">
                        id: {{ $tareas[$x]->id }}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse{{ $x }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{ $x }}">
                        <div class="accordion-body">
                            <p><b>Fecha reportado: </b>{{ $tareas[$x]->fecha_creacion }}</p>
                            <p><b>REF: </b>{{ $tareas[$x]->ascensor_ref }}</p>
                            <p><b>Tipo: </b>{{ $tareas[$x]->tipo }}</p>
                            <p><b>Descripcion: </b><br>{{ $tareas[$x]->descripcion }}</p>
                            <hr>
                            <p><b>Estado: </b>{{ $tareas[$x]->estado }}</p>
                            <p><b>Cliente: </b>{{ $tareas[$x]->cliente_id }}</p>
                            <p><b>Operador: </b>{{ $tareas[$x]->operador_codigo }}</p>
                            <p><b>Tecnico: </b>{{ $tareas[$x]->tecnico_codigo }}</p>
                        </div>
                    </div>
                </div>
            @endfor
        @else
        <p>el historial esta vacio</p>
        @endif
    </div>
    
@endsection