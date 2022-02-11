@extends('layouts.app')
@section('content')
    <div class="d-flex flex-column  align-items-center">
        <div class="row">
            <div class="col-12">
                <h2 class="user-select-none">Datos Modelo</h2>
            </div>
        </div>

        <style>
            .form-control.no-edit:hover {
                cursor: pointer;
                color: rgb(121, 58, 184) !important;
                border-color: rgb(121, 58, 184);
            }
        </style>

        <div class="row">
            <div class="col-12">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @elseif(session()->has('exito'))
                    <div class="alert alert-success">
                        {{ session()->get('exito') }}
                    </div>
                @endif
                <p id="nombre" aria-disabled="true" class="user-select-none form-control no-edit bg-dark rounded-pill text-black">{{ $modelo->nombre}}</p>
                <p  id="num_puertas" aria-disabled="true" class="user-select-none form-control no-edit bg-dark rounded-pill text-black">Número de puertas: {{ $modelo->num_puertas}}</p>
                <p id="peso_max" aria-disabled="true" class="user-select-none form-control no-edit bg-dark rounded-pill text-black">Peso máximo soportado: {{ $modelo->peso_max}}</p>
                <p  id="num_persona" aria-disabled="true"  class="user-select-none form-control no-edit bg-dark rounded-pill text-black">Número máximo de personas: {{ $modelo->num_personas}}</p>
                <p id="llave" aria-disabled="true" class="user-select-none form-control no-edit bg-dark rounded-pill text-black">Llave necesaria: {{ $modelo->llave ? 'Sí' : 'No'}}</p>
                <p id="tipo_accionamiento" aria-disabled="true" class="user-select-none form-control no-edit bg-dark rounded-pill text-black">Tipo accionamiento: {{ Str::ucfirst($modelo->tipoaccionamiento)}}</p>
                <p id="tipo_accionamiento" aria-disabled="true" class="user-select-none form-control no-edit bg-dark rounded-pill text-black">
                    <a class="link-success" href="{{ route('descargar.manual.modelo', ['modelo_id' => $modelo->id ]) }}">Descargar manual PDF</a>
                </p>
                @if(Auth::user()->rol == "jefeequipo" || Auth::user()->rol == "administrador")
                    <form action="{{ route('modelos.store', $modelo->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label class="user-select-none mt-2" for="file">Reemplazar manual</label>
                        <input type="hidden" name="modelo_id" value="{{ $modelo->id }}">
                        <input type="file" name="manual" id="manual" class="mt-2 form-control bg-dark rounded-pill text-black" />
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class=" mt-2 btn btn-outline-light text-black">Actualizar</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
