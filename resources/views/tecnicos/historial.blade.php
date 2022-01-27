<?php /*
    vista del historial de tareas que ha realizado el tecnico
*/?>
@extends('layouts.tecnico')

@section('title')
Historial
@endsection

@section('content')
    <p class="display-4">Historial</p>
    <form action="">
        <div class="input-group mb-3">
            <input type="text" name="" class="form-control" placeholder="buscar">
            <button class="btn btn-outline-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
            buscar por fecha
            </label>
        </div>
    </form>
    <ul class="list-group">
        <!-- despues blade generara los item de esta lista-->
        <li class="list-group-item">esto es una tarea</li>
        <li class="list-group-item">esto es una tarea</li>
        <li class="list-group-item">esto es una tarea</li>
        <li class="list-group-item">esto es una tarea</li>
        <li class="list-group-item">esto es una tarea</li>
    </ul>
@endsection