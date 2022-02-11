@extends('layouts.layout_estadisticas')
@section('content')
<div class="col-12 d-flex flex-column align-items-center">
    <div class="row">
        <div class="col-12">
           <h2>Estadisticas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <form action="{{ url('estadisticas.create') }}" id="formu" method="get">
                @csrf
                <select id="opcionesEstadisticas" class="col-12 mt-2 rounded-pill bg-dark text-center">
                        <option id="t1" value="default" disabled selected>Selecciona una opción</option>
                        <option id="t1" value="estadistica1">Cada t&eacute;cnico cuantos ascensores ha arreglado</option>
                        <option value="estadistica2">
                            @if (Auth::user()->rol == "administrador")
                            Cuantos ascensores han arreglado en el &uacute;ltimo a&ntilde;o en total
                            @else
                            Tu equipo cuantos ascensores ha arreglado en el &uacute;ltimo a&ntilde;o
                            @endif
                        </option>
                        <option value="estadistica3">TOP 5 de ascensores con m&aacute;s aver&iacute;as</option>
                    </select>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div id="container1" style="display: none;"></div>
            <div id="container2" style="display: none;"></div>
            <div id="container3" style="display: none;"></div>
        </div>
    </div>
</div>
@endsection
