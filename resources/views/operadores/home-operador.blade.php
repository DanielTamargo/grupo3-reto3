@extends('layouts.app')
@section('content')

        <div class="col-12 h-75 d-flex flex-column justify-content-center align-items-center ">

            <div class="row ">
                <div class="col-12">
                    <h2>¡Bienvenido/a {{Auth::user()->nombre}}!</h2> 
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-3 d-flex justify-content-center flex-wrap">
                    <boton-panel
                    texto="Registrar nueva tarea"
                    rol="operador"
                    id_p="1"
                    ruta="{{ route('nuevatarea.create') }}"></boton-panel>
                    <boton-panel
                    texto="Ver historial de tareas"
                    rol="operador"
                    id_p="3"
                    ruta="#"></boton-panel>
                    <boton-panel
                    texto="Ver ascensores instalados"
                    rol="operador"
                    id_p="3"
                    ruta="{{ route('ascensores.index') }}"></boton-panel>
                   
                </div>
            </div>

        </div>
        {{-- Script web components --}}
    <script type="module" src="{{ asset('js/components/importar-boton-panel.js')}}" defer></script>
@endsection