<?php /*
    vista donde los tecnicos dan parte de las tareas que realizan
*/?>
@extends('layouts.tecnico')

@section('title')
Igobide | Parte
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
                        <option value="incidencia" selected>Incidencia</option>
                        <option value="averia">Avería</option>
                        <option value="revision">Revisión</option>
                        @break

                    @case('averia')
                        <option value="incidencia">Incidencia</option>
                        <option value="averia" selected>Avería</option>
                        <option value="revision">Revisión</option>
                        @break
                    @case('revision')
                        <option value="incidencia">Incidencia</option>
                        <option value="averia">Avería</option>
                        <option value="revision" selected>Revisión</option>
                        @break
                @endswitch
            </select>
            <label for="est" class="form-label">Estado:</label>
            <select name="estado" id="est" class="form-select rounded-pill bg-azul1 text-white">
                <!-- posibles estados -->
                <option value="finalizado">Solucionado</option>
                <option value="materialrequerido">A la espera de piezas</option>
                <option value="retrasado">Retrasado</option>
                <option value="imposiblesolucionar">Sin solución</option>
                <option value="sintratar" selected>Sin tratar</option>
            </select>
            <label for="anot" class="form-label">Ovservaciones:</label>
            <textarea name="anotacion" id="anot" cols="30" rows="10" class="form-control rounded-3 bg-azul1 text-white" required></textarea>
            <input type="submit" value="Finalizar" class="mt-2 btn btn-outline-light float-end">
        </form>
@endsection