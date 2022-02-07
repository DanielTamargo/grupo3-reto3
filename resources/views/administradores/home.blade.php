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
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
        Toast.fire({
            icon: 'success',
            title: 'Usuario creado con éxito'
        });
    </script>
    @endif

    @if (isset($tarea_creada) && $tarea_creada)
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        const Toast2 = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
        Toast2.fire({
            icon: 'success',
            title: 'Tarea creada con éxito'
        });
    </script>
    @endif

    {{-- Contenido --}}
    <div class="col-12 h-75 d-flex flex-column justify-content-center align-items-center">
        <div class="container ">

            <div class="row user-select-none">
                <div class="col-12 d-flex justify-content-center">
                    <h2>¡Bienvenido/a {{ Auth::user()->nombre }}!</h2>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <p>¿Qué quieres hacer?</p>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
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
                    ruta="{{ route('estadisticas.create') }}"></boton-panel>
                    <boton-panel
                    texto="Ver ascensores instalados"
                    rol="administrador"
                    id_p="4"
                    ruta="{{ route('ascensores.index') }}"></boton-panel>
                    <boton-panel
                    texto="Crear una nueva tarea"
                    rol="administrador"
                    id_p="6"
                    ruta="{{ route('nuevatarea.create') }}"></boton-panel>
                    <boton-panel
                    texto="Ver listado de tareas general"
                    rol="administrador"
                    id_p="6"
                    ruta=""></boton-panel>
                </div>
            </div>
        </div>
    </div>

    {{-- Script web components --}}
    <script type="module" src="{{ asset('js/components/importar-boton-panel.js')}}" defer></script>

@endsection
