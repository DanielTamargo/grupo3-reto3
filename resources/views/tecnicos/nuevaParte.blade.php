<?php /*
    vista donde los tecnicos dan parte de las tareas que realizan
*/?>
@extends('layouts.tecnico')

@section('title')
Parte
@endsection

@section('content')
        <p class="display-4">Hacer parte</p>
        <form action="{{ route('partes.store') }}" method="POST">
            @csrf
            <label for="id" class="form-label">Identificador de tarea:</label>
            <input type="text" name="idtarea" id="id" class="form-control rounded-pill bg-azul1 text-white" value="{{ $tarea->id }}" readonly>
            <label for="tipo" class="form-label">Tipo:</label>
            <select name="tipo" id="tipo" class="form-select rounded-pill bg-azul1 text-white">
                @switch($tarea->tipo)
                    @case('incidencia')
                        <option value="incidencia" selected>incidencia</option>
                        <option value="averia">averia</option>
                        <option value="revision">revision</option>
                        @break

                    @case('averia')
                        <option value="incidencia">incidencia</option>
                        <option value="averia" selected>averia</option>
                        <option value="revision">revision</option>
                        @break
                    @case('revision')
                        <option value="incidencia">incidencia</option>
                        <option value="averia">averia</option>
                        <option value="revision" selected>revision</option>
                        @break
                @endswitch
            </select>
            <label for="est" class="form-label">Estado:</label>
            <select name="estado" id="est" class="form-select rounded-pill bg-azul1 text-white">
                <!-- posibles estados -->
                <option value="finalizado">solucionado</option>
                <option value="materialrequerido">en espera de piezas</option>
                <option value="retrasado">retrasado</option>
                <option value="imposiblesolucionar">fuera de servicio</option>
                <option value="sintratar" selected>sin hacer</option>
            </select>
            <label for="anot" class="form-label">Ovservaciones:</label>
            <textarea name="anotacion" id="anot" cols="30" rows="10" class="form-control rounded-3 bg-azul1 text-white" required></textarea>
            <input type="submit" value="Finalizar" class="mt-2 btn btn-outline-light float-end">
        </form>
@endsection