@extends('layouts.app')

@section('title')
Igobide | Ascensores
@endsection

@section('content')
    <div class="container px-4">
        <input type="hidden" id="seleccionar-ascensor" value="{{ isset($seleccionar_ascensor) && $seleccionar_ascensor ? 'true' : 'false' }}">
        <input type="hidden" id="assets-component-index-ascensores" value="{{ asset('js/components/index-ascensores.js') }}">
        <input type="hidden" id="ruta-show-modelo" value="{{ route('modelos.show', ['id' => 'modelo_id']) }}">
        
        
        {{-- <index-ascensores 
            seleccionar_ascensor="{{ isset($seleccionar_ascensor) && $seleccionar_ascensor ? 'true' : 'false' }}"
            link_css="{{ asset('css/app.css') }}"
        ></index-ascensores> --}}
        <div class="ascensores">
            
            <h3 class="text-muted">Lista de ascensores instalados</h3>  
            <div class="row my-3">
                <div class="col-4">
                    <p class="mb-1">Número de referencia</p>
                    <input class="form-control bg-dark" id="filtro-num_ref" type="text" placeholder="Código referencia">
                </div>
                <div class="col-8">
                    <p class="mb-1">Ubicación</p>
                    <input class="form-control bg-dark" id="filtro-ubicacion" type="text" placeholder="Dirección">
                </div>
            </div>      
            <table class="border table table-hover rounded empleados">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Num. Ref.</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Ubicación</th>
                        @if (isset($seleccionar_ascensor) && $seleccionar_ascensor)
                            <th scope="col">Acción</th>
                        @else
                            <th scope="col">F.Instalación</th>
                            <th scope="col">F.Ult.Revisión</th> 
                        @endif
                    </tr>
                </thead>
                <tbody id="lista-ascensores">
                    @foreach ($ascensores as $ascensor)
                        <tr>
                            <th scope="row">{{ $ascensor->num_ref }}</th>
                            @if (isset($seleccionar_ascensor) && $seleccionar_ascensor)
                                <td>{{ $ascensor->modelo->nombre }}</td>
                            @else
                                <td><a class="empleados" href="{{ route('modelos.show', ['id' => $ascensor->modelo->id]) }}">{{ $ascensor->modelo->nombre }}</a></td>
                            @endif
                            <td>{{ $ascensor->ubicacion }}</td>
                            @if (isset($seleccionar_ascensor) && $seleccionar_ascensor)
                                <td><a class="empleados" id="ascensor-{{ $ascensor->num_ref }}" onclick="seleccionarAscensor(this)" href="#seleccion-ascensor">Seleccionar</a></td>    
                            @else
                                <td>{{ $ascensor->fecha_instalacion }}</td>
                                <td>{{ $ascensor->fecha_ultima_revision }}</td>
                            @endif
                        </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="{{ asset('js/lib/jquery-3.6.0.min.js')}}"></script>
        <script src="{{ asset('js/views/ascensores.js')}}" defer></script>  
         
    </div>
@endsection