@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Página de pruebas: Listar todos los usuarios y usar sus relaciones</div>
                <div class="card-body">
                    <h3>Usuarios</h3>
                    @forelse ($users as $user)
                        <p class="mb-0">{{ $user->id }} | {{ $user->email }} | {{ $user->nombre }} {{ $user->apellidos }}
                        @if ($user->puesto)
                            <b>({{ $user->rol }} | Código: {{ $user->puesto->codigo }})</b>
                        @else
                            <b>(sin rol)</b>
                        @endif
                        </p>
                    @empty
                        <p>Sin usuarios registrados</p>
                    @endforelse

                    <hr>
                    <h3>Jefes de equipo</h3>
                    @forelse ($jefesequipos as $jefeequipo)
                        <p class="mb-0">Jefe de equipo {{ $jefeequipo->codigo }} |
                            {{ $jefeequipo->user->nombre }} {{ $jefeequipo->user->apellidos }} |
                            Número de empleados: {{ count($jefeequipo->tecnicos) }}</p>
                    @empty
                        <p>Sin jefes de equipo registrados</p>
                    @endforelse

                    <hr>
                    <h3>Técnicos</h3>
                    @forelse ($tecnicos as $tecnico)
                        <p class="mb-0">Técnico {{ $tecnico->codigo }} |
                            {{ $tecnico->user->nombre }} {{ $tecnico->user->apellidos }} |
                            Jefe: {{ $tecnico->jefe->user->nombre . " " . $tecnico->jefe->user->apellidos }}</p>
                    @empty
                        <p>Sin técnicos registrados</p>
                    @endforelse

                    <hr>
                    <h3>Operadores</h3>
                    @forelse ($operadores as $operador)
                        <p class="mb-0">Operador {{ $operador->codigo }} | {{ $operador->user->nombre }} {{ $operador->user->apellidos }}</p>
                    @empty
                        <p>Sin operadores registrados</p>
                    @endforelse
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection
