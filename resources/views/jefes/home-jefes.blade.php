@extends('layouts.app')
@section('content')
<div class="col-12 h-75 d-flex flex-column justify-content-center align-items-center ">

<div class="row ">
    <div class="col-12">
        <h2>¡Bienvenido/a {{Auth::user()->nombre}}! </h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <p>¿Qué quieres hacer?</p>
    </div>
</div>

<div class="row">
    
        
        <div class="col-12 mb-3 d-flex justify-content-center flex-wrap">
                    <boton-panel
                    texto="Ver estadísticas"
                    rol="jefeequipo"
                    id_p="1"
                    ruta="{{ route('estadisticas.create') }}"></boton-panel>
                    <boton-panel
                    texto="Alta usuarios"
                    rol="jefeequipo"
                    id_p="2"
                    ruta="{{ route('empleados.new') }}"></boton-panel>
                    <boton-panel
                    texto="Ver lista de usuarios"
                    rol="jefeequipo"
                    id_p="3"
                    ruta="{{ route('empleados.index') }}"></boton-panel>
                    <boton-panel
                    texto="Ver ascensores"
                    rol="jefeequipo"
                    id_p="4"
                    ruta="{{ route('ascensores.index') }}"></boton-panel>
                    <boton-panel
                    texto="Ver historial tareas"
                    rol="jefeequipo"
                    id_p="5"
                    ruta="{{route('tareas.index')}}"></boton-panel>
                    <boton-panel
                    texto="Ver listado de modelos"
                    rol="jefeequipo"
                    id_p="6"
                    ruta="{{route('modelos.index')}}"></boton-panel>
                </div>
   
</div>

</div>
{{-- Script web components --}}
    <script type="module" src="{{ asset('js/components/importar-boton-panel.js')}}" defer></script>
@endsection