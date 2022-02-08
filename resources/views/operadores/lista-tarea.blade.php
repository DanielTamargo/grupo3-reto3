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
            <select id="tipo" class="col-12 mt-2 rounded-pill bg-dark text-center">
                        <option id="t1" value="" disabled selected>Selecciona una opción</option>
                        <option id="t1" value="averia">Aver&iacute;a</option>
                        <option value="revision">Revisi&oacute;n</option>
                        <option value="incidencia">Incidencia</option>
                    </select>
        </div>
        <div class="col-3">
            <p class="mb-1">Estado</p>
            <select id="estado" class="col-12 mt-2 rounded-pill bg-dark text-center">
                        <option id="e1" value="" disabled selected>Selecciona una opción</option>
                        <option id="t1" value="finalizado">Finalizado</option>
                        <option value="sintratar">Sin tratar</option>
                        <option value="retrasado">Retrasado</option>
                        <option value="imposiblesolucionar">Imposible solucionar</option>
                        <option value="materialnecesario">Se necesita material</option>
                    </select>
        </div>
        </div>   
        <div class="row">
            <div class="col-12 d-flex justify-content-between mb-2">
                <button class="btn btn-outline-light" onclick="mostrarTareas(false)">&#60;</button>
                <button class="btn btn-outline-light" onclick="mostrarTareas(true)">&#62;</button>
            </div>
        </div>
        <thead>
            <tr class="table-primary">
                <th scope="col">Codigo</th>
                <th scope="col">Fecha Inico</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col">Referencia Ascensor</th>
                <th scope="col">T&eacute;cnico</th>
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