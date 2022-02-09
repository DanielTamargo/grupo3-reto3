@extends('layouts.app')

@section('title')
    Igobide | Tareas
@endsection

@section('content')
<div class="col-12">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (isset($_GET["tarea_creada"]) && $_GET["tarea_creada"])
    <script type="text/javascript">
        const Toast2 = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
        Toast2.fire({
            icon: 'success',
            title: 'Tarea creada con éxito'
        });
    </script>
    @endif

    <input type="hidden" id="ruta-show-modelo" value="{{ route('modelos.show', ['id' => 'modelo_id']) }}">
    <input type="hidden" id="ruta-show-tecnico" value="{{ route('empleados.show', ['user_id' => 'empleado_id']) }}">

    <div class="row">
        <div class="col-3">
            <p class="mb-1">Número de referencia</p>
            <input class="form-control bg-dark" id="filtro-num_ref" type="text" placeholder="Código referencia">
        </div>
        <div class="col-3">
            <p class="mb-1">Tipo</p>
            <select id="tipo" class="col-12 mt-2 rounded-pill bg-dark text-center">
                        <option id="t1" value="" selected>Sin seleccionar</option>
                        <option id="t1" value="averia">Aver&iacute;a</option>
                        <option value="revision">Revisi&oacute;n</option>
                        <option value="incidencia">Incidencia</option>
                    </select>
        </div>
        <div class="col-3">
            <p class="mb-1">Estado</p>
            <select id="estado" class="col-12 mt-2 rounded-pill bg-dark text-center">
                        <option id="e1" value="" selected>Sin seleccionar</option>
                        <option id="t1" value="finalizado">Finalizado</option>
                        <option value="sintratar">Sin tratar</option>
                        <option value="retrasado">Retrasado</option>
                        <option value="imposiblesolucionar">Imposible solucionar</option>
                        <option value="materialnecesario">Se necesita material</option>
                    </select>
        </div>
        <div class="row mt-2">
            <div class="col-12 d-flex justify-content-between mb-2">
                <button class="btn btn-outline-light" onclick="mostrarTareas(false)">&#60;</button>
                <button class="btn btn-outline-light" onclick="mostrarTareas(true)">&#62;</button>
            </div>
        </div>
    </div>
    <table class="border table table-hover rounded empleados">
        <thead>
            <tr class="table-primary">
                <th scope="col">Codigo</th>
                <th scope="col">Fecha Inico</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Tipo</th>
                <th scope="col">Referencia Ascensor</th>
                <th scope="col">T&eacute;cnico</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody class="tareas">

        </tbody>
    </table>
</div>
<script src="{{ asset('/js/lib/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('/js/tareas.js') }}"></script>
@endsection
