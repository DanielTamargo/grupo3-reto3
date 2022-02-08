@extends('layouts.app')

@section('content')
    <div class="container px-4">
        @if (Auth::user()->rol == "administrador")
            <h3 class="text-black">Lista de usuarios registrados</h3>
        @else
            <h3 class="text-black">Lista de técnicos a tu cargo</h3>
        @endif
        <a href="{{ route('empleados.new') }}" class="btn btn-outline-success my-3">Nuevo empleado</a>
        <a href="{{ route('empleados.export.excel') }}" class="btn btn-outline-light my-3">Exportar a Excel</a>
        <a href="{{ route('empleados.export.csv') }}" class="btn btn-outline-light my-3">Exportar a CSV</a>
        <table class="border table table-hover rounded empleados">
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
                        <td>
                            <div class="row">
                                @if ($usuario->rol == "tecnico")
                                    <a href="{{ route('tecnico.historial', ['cod' => $usuario->puesto->codigo]) }}" class="col-3 empleados" data-bs-toggle="tooltip" data-bs-placement="top" title="Historial"> <!-- Ver historial tareas -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                    </a>
                                @else
                                    <div class="col-3"></div> <!-- Espaciado si no es técnico -->
                                @endif
                                <a href="{{ route('empleados.edit', ['user_id' => $usuario->id]) }}" class="col-3 empleados" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"> <!-- Editar empleado -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('empleados.delete', ['user_id' => $usuario->id]) }}" class="col-3 empleados" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"> <!-- Eliminar empleado -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    {{-- Bootstrap tooptips --}}
                    <script src="{{ asset('js/lib/bootstrap.bundle.min.js')}}"></script>
                    <script type="text/javascript">
                        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                            return new bootstrap.Tooltip(tooltipTriggerEl);
                        });
                    </script>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection
