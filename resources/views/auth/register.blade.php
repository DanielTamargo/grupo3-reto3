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
                            {{-- Las enum no funcionan :(
                            <option value="{{ \App\Models\Enums\Roles::OPERADOR }}">Operador</option>
                            <option value="{{ \App\Models\Enums\Roles::TECNICO }}">Técnico</option>
                            <option value="{{ \App\Models\Enums\Roles::JEFEEQUIPO }}">Jefe de Equipo</option>
                            <option value="{{ \App\Models\Enums\Roles::ADMINISTRADOR }}">Administrador</option>
                             --}}
                          </select>
                    </div>
                    <div class="mb-3 col-12 col-md-8 col-xl-6">
                        <label for="jefe_codigo" class="">Jefe Asignado</label>
                        <input required type="text" name="jefe_codigo" id="registro-jefe-codigo" class="form-control" placeholder="">
                    </div>
                </div>
                <button type="submit" id="registro-submit" class="btn btn-primary">Registrar Empleado</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/lib/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('js/views/register.js')}}"></script>

@endsection
