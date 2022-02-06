@extends('layouts.app')
@section('content')
    <div class="col-12 h-75 d-flex flex-column justify-content-center align-items-center">
        <div class="row">
            <div class="col-12">
                <h2>Modificar Modelo</h2>
            </div>
        </div>

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
                <p id="nombre" aria-disabled="true" class="form-control bg-dark rounded-pill text-black">{{ $modelo->nombre}}</p>
                <p  id="num_puertas" aria-disabled="true" class="form-control bg-dark rounded-pill text-black">{{ $modelo->num_puertas}}</p>
                <p id="peso_max" aria-disabled="true" class="form-control bg-dark rounded-pill text-black">{{ $modelo->peso_max}}</p>
                <p  id="num_persona" aria-disabled="true"  class="form-control bg-dark rounded-pill text-black">{{ $modelo->num_personas}}</p>
                <p id="llave" aria-disabled="true" class="form-control bg-dark rounded-pill text-black">{{ $modelo->llave}}</p>
                <p id="tipo_accionamiento" aria-disabled="true" class="form-control bg-dark rounded-pill text-black">{{ $modelo->tipoaccionamiento}}</p>
                <form action="{{ route('modelos.store', $modelo->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="manual" id="manual" class="mt-2 form-control bg-dark rounded-pill text-black"/>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class=" mt-2 btn btn-outline-light text-black">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection