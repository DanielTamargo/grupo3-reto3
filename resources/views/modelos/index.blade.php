@extends('layouts.app')

@section('title')
Igobide | Modelos
@endsection

@section('content')
    <div class="container px-4">
        <div class="modelos">
            <h3 class="text-black">Lista de modelos</h3>
            <table class="border table table-hover rounded empleados">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Nombre</th>
                        <th scope="col">Accionamiento</th>
                        <th scope="col">Llave</th>
                        <th scope="col">Pexo Max.</th>
                        <th scope="col">Max. Personas</th>
                        <th scope="col">Descargar</th>
                    </tr>
                </thead>
                <tbody id="lista-modelos">
                    @foreach ($modelos as $modelo)
                        <tr>
                            <th scope="col"><a class="empleados" href="{{ route('modelos.show', ['id' => $modelo->id]) }}">{{ $modelo->nombre }}</a></th>
                            @switch($modelo->tipoaccionamiento)
                                @case('hidraulico')
                                    <td>Hidráulico</td>
                                    @break
                                @case('electrico')
                                    <td>Eléctrico</td>
                                    @break
                                @default
                                    <td>Eléctrico</td>
                            @endswitch
                            <td>{{ $modelo->llave ? 'Sí' : 'No' }}</td>
                            <td>{{ $modelo->peso_max }}</td>
                            <td>{{ $modelo->num_personas }}</td>
                            <td><a href="{{ route('descargar.manual.modelo', ['modelo_id' => $modelo->id ]) }}">{{ $modelo->nombre }}.pdf</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
