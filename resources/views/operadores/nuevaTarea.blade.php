@extends('layouts.app')

@section('title')
Igobide | Nueva tarea
@endsection

@section('content')
{{-- INICIO MODAL ASCENSORES --}}
<div class="modal fade container-fluid w-100" id="modal-ascensores" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Selecciona un ascensor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container px-4">
                    <input type="hidden" id="seleccionar-ascensor" value="{{ isset($seleccionar_ascensor) && $seleccionar_ascensor ? 'true' : 'false' }}">
                    <input type="hidden" id="ruta-show-modelo" value="{{ route('modelos.show', ['id' => 'modelo_id']) }}">

                    {{-- <index-ascensores
                        seleccionar_ascensor="{{ isset($seleccionar_ascensor) && $seleccionar_ascensor ? 'true' : 'false' }}"
                        link_css="{{ asset('css/app.css') }}"
                    ></index-ascensores> --}}
                    <div class="ascensores">
                        <h3 class="text-black">Lista de ascensores instalados</h3>
                        <div class="row my-3">
                            <div class="col-4">
                                <p class="mb-1">Número de referencia</p>
                                <input class="form-control" style="background-color: white" id="filtro-num_ref" type="text" placeholder="Código referencia">
                            </div>
                            <div class="col-8">
                                <p class="mb-1">Ubicación</p>
                                <input class="form-control" style="background-color: white" id="filtro-ubicacion" type="text" placeholder="Dirección">
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

{{-- INICIO MODAL TECNICOS --}}
<div class="modal fade container-fluid w-100" id="modal-tecnicos" tabindex="-2">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Selecciona un técnico</h5>
            <h5 class="modal-title text-black ms-2" id="exampleModalLabel">(ordenado por número de urgencias y tareas pendientes)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container px-4">
                    <div class="ascensores">
                        <h3 class="text-black">Lista de técnicos</h3>
                        <table class="border table table-hover rounded empleados">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th class="d-sm-none d-md-block" scope="col">Jefe</th>
                                    <th scope="col">Pendientes</th>
                                    <th scope="col">Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody id="lista-tecnicos">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- FIN MODAL TECNICOS --}}

<div class="col-12 d-flex flex-column justify-content-center align-items-center">
    <div class="row">
        @if ($errors->any())
            <div class="col-12 alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12">
            <h2>Nueva Averia</h2>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-12">

            <form id="form-nueva-tarea" action="{{ route('tarea.store') }}" method="post">
            @csrf
                @if (Auth::user()->rol == "operador")
                    <input type="hidden" name="operador_codigo" value="{{ Auth::user()->puesto->codigo }}">
                @else
                    @if (isset($operadores))
                        <h3 class="text-black">Operador asignado</h3>
                        <div class="row mb-3">
                            <div class="col-12">
                                <select id="tipo-averia" name="operador_codigo" class="col-12 mt-2 rounded-pill bg-dark text-center">
                                    @foreach ($operadores as $operador)
                                        <option value="{{ $operador->codigo }}" @if(old('operador_codigo') == $operador->codigo) selected @endif>{{ $operador->user->nombre }} {{ $operador->user->apellidos }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="operador_codigo" value="{{ \App\Models\Operador::all()->first()->codigo }}">
                    @endif
                @endif

                <h3 class="text-black">Datos cliente</h3>
                <div class="row">
                    <div class="col-12">
                        <input type="text" value="{{ old('cliente_nombre') }}" required type="tel" name="cliente_nombre" placeholder="Nombre" class="form-control rounded-pill mt-2 bg-dark"/>
                        <input type="text" value="{{ old('cliente_email') }}" required type="tel" name="cliente_email" placeholder="Email" class="form-control rounded-pill mt-2 bg-dark"/>
                    </div>
                </div>

                <hr>
                <h3 class="text-black">Datos tarea</h3>
                <div class="row">
                    <div class="col-12">
                        <input type="text" value="{{ old('ascensor_num_ref') }}" required type="text" id="ascensor_num_ref" name="ascensor_num_ref" placeholder="Número de referencia ascensor" class="form-control rounded-pill mt-2 bg-dark"/>
                    </div>
                    <div class="col-12">
                        <p id="seleccionar-ascensor" class="btn btn-primary w-100 rounded-pill mt-2 text-white" data-bs-toggle="modal" data-bs-target="#modal-ascensores">Seleccionar Ascensor</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="text" value="{{ old('tecnico_codigo') }}" required type="text" id="tecnico_codigo" name="tecnico_codigo" placeholder="Código del técnico" class="form-control rounded-pill mt-2 bg-dark"/>
                    </div>
                    <div class="col-12">
                        <p id="seleccionar-tecnico" class="btn btn-primary w-100 rounded-pill mt-2 text-white" data-bs-toggle="modal" data-bs-target="#modal-tecnicos">Seleccionar Técnico</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <p class="text-center mb-0">Tipo de tarea</p>
                        <select id="tipo-averia" name="tipo" class="col-12 mt-0 rounded-pill bg-dark text-center">
                            <option value="incidencia" @if(old('tipo') == "incidencia") selected @endif>Incidencia</option>
                            <option value="averia" @if(old('tipo') == "averia") selected @endif>Avería</option>
                            <option value="revision" @if(old('tipo') == "revision") selected @endif>Revisión</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <p id="prioridad-texto" class="text-center mb-0">Prioridad de la tarea - Baja</p>
                        <div class="row">
                            <div class="col-10">
                                <input id="prioridad-range" type="range" class="form-range" value="{{ old('prioridad') ? old('prioridad') : '1' }}" min="1" max="5">
                            </div>
                            <div class="col-2 nt">
                                <input class="bg-dark" style="border: none;" type="number" name="prioridad" id="prioridad" value="{{ old('prioridad') ? old('prioridad') : '1' }}" max="5" min="1">
                            </div>
                        </div>
                        <div class="progress">
                            <div id="prioridad-pb-1" class="progress-bar" role="progressbar" style="width: 20%; background-color: rgb(59, 180, 59)" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div id="prioridad-pb-2" class="progress-bar" role="progressbar" style="width: 20%; background-color: rgb(80, 80, 206)" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div id="prioridad-pb-3" class="progress-bar" role="progressbar" style="width: 20%; background-color: yellow" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div id="prioridad-pb-4" class="progress-bar" role="progressbar" style="width: 20%; background-color: rgb(236, 171, 49)" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div id="prioridad-pb-5" class="progress-bar" role="progressbar" style="width: 20%; background-color: darkred" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <textarea name="descripcion" id="descripcion" cols="50" rows="10" placeholder="Descripción" class="form-control rounded mt-2 bg-dark">{{ old('descripcion') }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex mt-2 justify-content-center bg-dark ">
                        <button type="submit" class="btn btn-outline-light mt-2 mb-5">Crear Tarea</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script src="{{ asset('js/lib/jquery-3.6.0.min.js')}}" defer></script>
    <script src="{{ asset('js/views/ascensores.js')}}" defer></script>
    <script src="{{ asset('js/views/tecnicos.js')}}" defer></script>
    <script src="{{ asset('js/views/nueva-tarea.js')}}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var modal_ascensores = document.getElementById('modal-ascensores');

        modal_ascensores.addEventListener('shown.bs.modal', function () {
            console.log('Modal Ascensores ON');
            obtenerDatos();
        });

        var modal_tecnicos = document.getElementById('modal-tecnicos');

        modal_tecnicos.addEventListener('shown.bs.modal', function () {
            console.log('Modal Técnicos ON');
            obtenerDatosTecnicos();
        });

        /* Spinner loading nueva tarea al hacer el submit
            Debido al envío de los emails, puede tardar un poco, el spinner ayuda a entender que se está procesando
        */
        document.getElementById('form-nueva-tarea').addEventListener('submit', (evt) => {
            Swal.showLoading();
        });
    </script>
</div>
@endsection
