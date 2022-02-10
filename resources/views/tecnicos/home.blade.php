<?php /*
    vista principal para los tecnicos
*/?>
@extends('layouts.app2')

@section('title')
Igobide | Home
@endsection

@section('maincontent')
    <script type="module" src="{{ asset('js/components/importar-boton-panel.js')}}" defer></script>
    <main class="col g-0 p-2 text-center">
        <div class="p-2 h-100 mb-1 d-flex justify-content-center flex-wrap">
            <p class="display-4">Bienvenido/a {{ $usuario }}</p>
            <boton-panel texto="Ver tareas pendientes" rol="tecnico" id_p="1" ruta="{{ route('tecnico.show') }}"></boton-panel>
            <boton-panel texto="Ver tareas realizadas" rol="tecnico" id_p="2" ruta="{{ route('tecnico.historial') }}"></boton-panel>
            <boton-panel texto="Descargar manuales" rol="tecnico" id_p="3" ruta="{{ route('tecnico.manual') }}"></boton-panel>
            <boton-panel texto="Pedir piezas" rol="tecnico" id_p="4" ruta="{{ route('tecnico.piezas') }}"></boton-panel>

        </div>
    </main>
@endsection