<?php /*
    vista donde los tecnicos podran descargar manuales de ascensores
*/?>
@extends('layouts.tecnico')

@section('title')
manuales
@endsection

@section('content')
    <p class="display-4">Manuales disponibles</p>
    <ul class="list-group text-white">
        <!-- despues blade generara los item de esta lista-->
        @if (count($manuales) != 0)
            @for ($x = 0; $x < count($manuales); $x++)
                <li class="list-group-item">{{ $manuales[$x] }} <a href="/descargar/manual/{{ $manuales[$x] }}" class="float-end">descargar</a></li>

            @endfor
        @else
        <p>error, no se encontraron manuales disponibles</p>
        @endif
    </ul>
@endsection