<?php /*
    vista donde los tecnicos pediran piezas que les falten para el ascensor
*/?>
@extends('layouts.tecnico')

@section('title')
Igobide | Pedir piezas
@endsection

@section('content')
    <p class="display-4">Pedir piezas</p>
    @if(session()->has('success'))
        <div class="alert alert-success">
            La petición fue enviada correctamente
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-warning">
            Hubo un problema al enviar
        </div>
    @else
    @endif
    <form action="{{route('tecnico.formpiezas')}}" method="POST">
        @csrf
        <label for="id" class="form-label">Modelo de ascensor:</label>
        <input type="text" name="" id="id" class="form-control rounded-pill bg-dark text-black" required>
        <label for="material" class="form-label">Material:</label>
        <textarea name="" id="material"  cols="30" rows="10" class="form-control rounded-3 bg-dark text-black" required></textarea>
        <input type="submit" value="Enviar" class="mt-2 btn btn-outline-light float-end">
    </form>
@endsection
