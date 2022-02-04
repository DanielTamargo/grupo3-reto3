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
            <input type="hidden" name="tecnico" value="{{ $codUsr }}">
            <label for="id" class="form-label">Identificador de tarea:</label>
            <input type="text" name="idtarea" id="id" class="form-control rounded-pill bg-azul1 text-white" value="{{ $idtarea }}" disabled>
            <label for="tipo" class="form-label">Tipo:</label>
            <select name="tipo" id="tipo" class="form-select rounded-pill bg-azul1 text-white">
                <option value="incidencia">incidencia</option>
                <option value="averia">averia</option>
                <option value="revision">revision</option>
            </select>
            <label for="est" class="form-label">Estado:</label>
            <select name="estado" id="est" class="form-select rounded-pill bg-azul1 text-white">
                <!-- posibles estados -->
                <option value="finalizado">solucionado</option>
                <option value="materialrequerido">en espera de piezas</option>
                <option value="retrasado">retrasado</option>
                <option value="imposiblesolucionar">fuera de servicio</option>
                <option value="sintratar">sin hacer</option>
            </select>
            <label for="anot" class="form-label">Ovservaciones:</label>
            <textarea name="anotacion" id="anot" cols="30" rows="10" class="form-control rounded-3 bg-azul1 text-white" required></textarea>
            <input type="submit" value="Finalizar" class="mt-2 btn btn-outline-light float-end">
        </form>
@endsection