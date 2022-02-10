<?php /*
    vista donde los tecnicos podran descargar manuales de ascensores
*/?>
@extends('layouts.tecnico')

@section('title')
Igobide | Manuales
@endsection

@section('content')
    <p class="display-4">Manuales disponibles</p>
    <ul class="list-group text-white">
        <!-- despues blade generara los item de esta lista-->
        @if (count($modelos) != 0)
            @foreach ($modelos as $modelo)
                <li class="list-group-item">{{ $modelo->nombre }}.pdf <a href="{{ route('descargar.manual.modelo', ['modelo_id' => $modelo->id ]) }}" class="float-end">Descargar</a></li>
            @endforeach
        @else
        <p>No hay manuales disponibles</p>
        @endif
    </ul>
@endsection