@extends('layouts.app')
@section('content')

{{-- INICIO MODAL ASCENSORES --}}
<div class="modal fade container-fluid w-100" id="modal-ascensores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                                <input class="form-control" id="filtro-num_ref" type="text" placeholder="Código referencia">
                            </div>
                            <div class="col-8">
                                <p class="mb-1">Ubicación</p>
                                <input class="form-control" id="filtro-ubicacion" type="text" placeholder="Dirección">
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
                                            
                            </tbody>
                        </table>
                    </div>
                    <script src="{{ asset('js/lib/jquery-3.6.0.min.js')}}"></script>
                    <script src="{{ asset('js/views/ascensores.js')}}" defer></script>  
                </div>
            </div>
        </div>
    </div>
</div>
{{-- FIN MODAL --}}

<div class="col-12 d-flex flex-column justify-content-center align-items-center">
    <div class="row">
        <div class="col-12">
            <h2>Nueva Averia</h2>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-12">
            <form action="" method="post">
            @csrf
                @if (Auth::user()->rol == "operador")
                    <input type="hidden" name="operador_codigo" value="{{ Auth::user()->puesto->codigo }}">
                @else
                    @if (isset($operadores))
                        <h3 class="text-muted">Seleccionar operador asignado</h3>
                        <div class="row mb-3">
                            <div class="col-12">
                                <select id="tipo-averia" name="operador_codigo" class="col-12 mt-2 rounded-pill bg-dark text-center">
                                    @foreach ($operadores as $operador)
                                        <option value="{{ $operador->codigo }}">{{ $operador->user->nombre }} {{ $operador->user->apellidos }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="operador_codigo" value="{{ \App\Models\Operador::all()->first()->codigo }}"> 
                    @endif
                @endif

                <h3 class="text-muted">Datos cliente</h3>
                <div class="row">
                    <div class="col-12">
                        <input type="tel" name="cliente_nombre" placeholder="Nombre" class="form-control rounded-pill mt-2 bg-dark"/>
                        <input type="tel" name="cliente_email" placeholder="Email" class="form-control rounded-pill mt-2 bg-dark"/>
                    </div>
                </div>

                <hr>
                <h3 class="text-muted">Datos tarea</h3>
                <div class="row">
                    <div class="col-12">
                        <input type="text" id="ascensor_num_ref" name="ascensor_num_ref" placeholder="Número de referencia ascensor" class="form-control rounded-pill mt-2 bg-dark"/>
                    </div>
                    <div class="col-12">
                        <p id="seleccionar-ascensor" class="btn btn-primary w-100 rounded-pill mt-2 text-white"  data-bs-toggle="modal" data-bs-target="#modal-ascensores">Seleccionar Ascensor</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="text" id="tecnico_codigo" name="tecnico_codigo" placeholder="Código del técnico" class="form-control rounded-pill mt-2 bg-dark"/>
                    </div>
                    <div class="col-12">
                        <p id="seleccionar-tecnico" class="btn btn-primary w-100 rounded-pill mt-2 text-white">Seleccionar Técnico</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <p class="text-center mb-0">Tipo de tarea</p>
                        <select id="tipo-averia" name="tipo" class="col-12 mt-0 rounded-pill bg-dark text-center">
                            <option value="incidencia">Incidencia</option>
                            <option value="averia">Avería</option>
                            <option value="revision">Revisión</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <p class="text-center mb-0">Prioridad de la tarea</p>
                        <div class="row">
                            <div class="col-10">
                                <input id="prioridad-range" type="range" class="form-range" value="1" min="1" max="5">
                            </div>
                            <div class="col-2 nt">
                                <input class="bg-dark" style="border: none;" type="number" name="prioridad" id="prioridad" value="1" max="5" min="1">
                            </div>
                        </div>
                        <div class="progress">
                            <div id="prioridad-pb-1" class="progress-bar" role="progressbar" style="width: 20%; background-color: rgb(59, 180, 59)" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div id="prioridad-pb-2" class="progress-bar d-none" role="progressbar" style="width: 20%; background-color: rgb(80, 80, 206)" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div id="prioridad-pb-3" class="progress-bar d-none" role="progressbar" style="width: 20%; background-color: yellow" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div id="prioridad-pb-4" class="progress-bar d-none" role="progressbar" style="width: 20%; background-color: rgb(236, 171, 49)" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div id="prioridad-pb-5" class="progress-bar d-none" role="progressbar" style="width: 20%; background-color: darkred" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                  
                <div class="row">
                    <div class="col-12">
                        <textarea name="descripcion" id="descripcion" cols="50" rows="10" placeholder="Descripción" class="form-control rounded mt-2 bg-dark"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex mt-2 justify-content-center bg-dark ">
                        <button type="submit" class="btn btn-outline-light"><a href="#" class="text-decoration-none">Crear Tarea</a></button>
                    </div>
                </div>
       
            </form>
        </div>
    </div>

    <script src="{{ asset('js/lib/jquery-3.6.0.min.js')}}" defer></script>  
    <script src="{{ asset('js/views/ascensores.js')}}" defer></script>  
    <script src="{{ asset('js/views/nueva-tarea.js')}}" defer></script>  
    <script>
        var myModal = document.getElementById('modal-ascensores')

        myModal.addEventListener('shown.bs.modal', function () {
            console.log('Modal Ascensores ON');
            obtenerDatos();
        })
    </script>
</div>
@endsection