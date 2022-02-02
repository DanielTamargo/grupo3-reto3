@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::user()->rol == "administrador")
            <h3>Lista de usuarios</h3>
        @else
            <h3>Lista de técnicos a tu cargo</h3>        
        @endif
        <table class="border table table-hover rounded">
            <thead>
                <tr class="table-primary">
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <th scope="row">{{ $usuario->puesto->codigo }}</th>
                        <td>{{ $usuario->nombre . " " . $usuario->apellidos }}</td>
                        <td>
                            @php
                                if ($usuario->rol == "operador") echo "Operador";
                                if ($usuario->rol == "tecnico") echo "Técnico";
                                if ($usuario->rol == "jefeequipo") echo "Jefe de Equipo";
                                if ($usuario->rol == "administrador") echo "Administrador";
                            @endphp
                        </td>
                        <td>WIP</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection