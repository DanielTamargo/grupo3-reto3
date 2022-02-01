@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-10 col-xs-12"> <!-- Responsive -->

            <h2 class="text-muted">Registrar nuevo empleado</h2>
            <hr>
            <form id="registro-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row mb-4">
                    <div class="mb-3 col-12 col-md-6 col-xl-4">
                        <label for="nombre" class="">Nombre</label>
                        <input required type="text" name="nombre" id="registro-nombre" class="form-control" placeholder="">
                    </div>

                    <div class="mb-3 col-12 col-md-6 col-xl-4">
                        <label for="nombre" class="">Apellidos</label>
                        <input required type="text" name="apellidos" id="registro-apellidos" class="form-control" placeholder="">
                    </div>

                    <div class="mb-3 col-12 col-md-4 col-xl-4">
                        <label for="nombre" class="">DNI</label>
                        <input required type="text" name="dni" id="registro-dni" class="form-control" placeholder="">
                    </div>

                    <div class="mb-3 col-12 col-md-8 col-xl-6">
                        <label for="nombre" class="">Email</label>
                        <div class="input-group">
                            <input required type="text" name="email" id="registro-email" class="form-control" placeholder="">
                            <span class="input-group-text" id="basic-addon2">@igobide.com</span>
                        </div>
                    </div>

                    <div class="mb-3 col-12 col-md-4 col-xl-4">
                        <label for="password" class="">Contraseña</label>
                        <input required type="text" name="password" id="registro-password" class="form-control" placeholder="" disabled>
                    </div>

                    <div class="mb-3 col-12 col-md-8 col-xl-6">
                        <label for="rol" class="">Rol</label>
                        <select name="rol" id="registro-rol" class="form-select">
                            <option value="operador">Operador</option>
                            <option value="tecnico">Técnico</option>
                            @if (Auth::user()->rol == "administrador")
                                <option value="jefeequipo">Jefe de Equipo</option>
                                <option value="administrador">Administrador</option>
                            @endif
                        </select>
                    </div>

                    <div class="mb-3 col-12 col-md-8 col-xl-6" id="registro-jefe-asignado">
                        {{-- Se cargan dinámicamente a través del script js --}}
                    </div>

                    <div class="mt-3 mb-3 col-12" id="registro-jefe-asignado-multiples-tecnicos">
                        <p class="p-3 border border-1 rounded border-danger">¡Ojo! El jefe seleccionado ya tiene asignados 5 o más técnicos a su cargo</p>
                    </div>
                </div>
                <button type="submit" id="registro-submit" class="btn btn-primary border border-secondary rounded">Registrar Empleado</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/lib/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('js/views/register.js')}}"></script>

@endsection
