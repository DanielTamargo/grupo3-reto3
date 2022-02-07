@extends('layouts.app')
@section('content')

        <div class="col-12 h-75 d-flex flex-column justify-content-center align-items-center ">

            <div class="row ">
                <div class="col-12">
                    <h2>Bienvenido!{{Auth::user()->nombre}}</h2> 
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-3 d-flex justify-content-center flex-wrap">
                    <boton-panel
                    texto="Nueva Averia"
                    rol="operador"
                    id_p="1"
                    ruta="{{ route('nuevatarea.create') }}"></boton-panel>
                    <boton-panel
                    texto="Ver últimas revisiones"
                    rol="operador"
                    id_p="3"
                    ruta="{{ route('#') }}"></boton-panel>
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