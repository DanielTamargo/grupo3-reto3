<?php /*
    vista donde los tecnicos pediran piezas que les falten para el ascensor
*/?>
@extends('layouts.tecnico')

@section('title')
manuales
@endsection

@section('content')
    <p class="display-4">Pedir piezas</p>
    <form action="">
        <label for="id" class="form-label">Modelo de ascensor:</label>
        <input type="text" name="" id="id" class="form-control">
        <label for="material" class="form-label">Material:</label>
        <textarea name="" id="material"  cols="30" rows="10" class="form-control"></textarea>
        <input type="submit" value="Enviar" class="mt-2 btn btn-primary float-end">
    </form>
@endsection