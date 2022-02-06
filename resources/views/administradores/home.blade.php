@extends('layouts.app')

{{-- Título de la página, si no se implementa el título será el por defecto de la aplicación --}}
@section('title')
Igobide | Administrador
@endsection

{{-- Contenido principal de la página --}}
@section('content')

    {{-- Si se ha marcado 'usuario creado' saltará la alerta correspondiente, proporcionando una experiencia más interactiva --}}
    @if (isset($usuario_creado) && $usuario_creado)
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        Swal.fire({
            text: 'El usuario se ha creado con éxito',
            icon: 'success',
            timer: 2000
        });
    </script>
    @endif

    {{-- Contenido --}}
    <div class="h-100">
        <div class="container">

            <div class="row user-select-none">
                <div class="col-12 d-flex justify-content-center">
                    <h2>¡Bienvenido/a {{ Auth::user()->nombre }}!</h2>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <p>¿Qué quieres hacer?</p>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-12 mb-3 d-flex justify-content-center flex-wrap">
                    <boton-panel
                    texto="Ver lista de empleados"
                    rol="administrador"
                    id_p="1"
                    ruta="{{ route('empleados.index') }}"></boton-panel>
                    <boton-panel
                    texto="Registrar un nuevo empleado"
                    rol="administrador"
                    id_p="2"
                    ruta="{{ route('empleados.new') }}"></boton-panel>
                    <boton-panel
                    texto="Consultar estadísticas"
                    rol="administrador"
                    id_p="3"
                    ruta="{{ route('empleados.new') }}"></boton-panel>
                    <boton-panel
                    texto="Ver ascensores instalados"
                    rol="administrador"
                    id_p="4"
                    ruta="{{ route('ascensores.index') }}"></boton-panel>
                    <boton-panel
                    texto="Ver modelos registrados"
                    rol="administrador"
                    id_p="5"
                    ruta="{{ route('modelos.index') }}"></boton-panel>
                </div>
            </div>
        </div>
    </div>

    {{-- Script web components --}}
    <script type="module" src="{{ asset('js/components/importar-boton-panel.js')}}" defer></script>

@endsection
