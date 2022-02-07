@extends('layouts.app')
@section('content')
<div class="col-12">
    <table class="border table table-hover rounded empleados">
    <div class="row my-3">
        <div class="col-3">
            <p class="mb-1">Número de referencia</p>
            <input class="form-control bg-dark" id="filtro-num_ref" type="text" placeholder="Código referencia">
        </div>
        <div class="col-3">
            <p class="mb-1">Tipo</p>
            <input class="form-control bg-dark" id="filtro-tipo" type="text" placeholder="Tipo">
        </div>
        <div class="col-3">
            <p class="mb-1">Estado</p>
            <input class="form-control bg-dark" id="filtro-estado" type="text" placeholder="Estado">
        </div>
        </div>   
        <div class="row">
            <div class="col-12 d-flex justify-content-between mb-2">
                <button class="btn btn-outline-light" onclick="diezAtras()">&#60;</button>
                <button class="btn btn-outline-light" onclick="diezDelante()">&#62;</button>
            </div>
        </div>
        <thead>
            <tr class="table-primary">
                <th scope="col">Codigo</th>
                <th scope="col">Fecha Inico</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col">Descripci&oacute;n</th>
            </tr>
        </thead>
        <tbody class="tareas">
            {{-- Bootstrap tooptips --}}
                <script src="{{ asset('js/lib/bootstrap.bundle.min.js')}}"></script>
                <script type="text/javascript">
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                </script>
  
        </tbody>
    </table>
</div>
<script src="{{ asset('/js/lib/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('/js/tareas.js') }}"></script>
@endsection