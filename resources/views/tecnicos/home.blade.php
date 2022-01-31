<?php /*
    vista principal para los tecnicos
*/?>
@extends('layouts.app2')

@section('title')
Home
@endsection

@section('maincontent')
    <main class="col g-0 p-2 text-center">
        <div class="p-2 bg-success h-100">
            <p class="display-4">Bienvenido $usuario</p>
            <a href="{{ route('tecnico.create') }}" class="btn btn-light w-75 mb-2">Rellenar partes</a>
            <a href="{{ route('tecnico.show') }}" class="btn btn-light w-75 mb-2">Ver tareas pendientes</a>
            <a href="{{ route('tecnico.historial') }}" class="btn btn-light w-75 mb-2">Ver tareas realizadas</a>
            <a href="{{ route('tecnico.manual') }}" class="btn btn-light w-75 mb-2">Descargar manuales</a>
            <a href="{{ route('tecnico.piezas') }}" class="btn btn-light w-75 mb-2">Pedir piezas</a>
        </div>
    </main>
@endsection