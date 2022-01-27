<?php /*
    vista principal para los tecnicos
*/?>
@extends('layouts.tecnico')

@section('title')
Home
@endsection

@section('content')
        <h3>Bienvenido usuario</h3>
        <p>para empezar a navegar pulsa en los botones de la derecha para acceder a los siguientes apartados:</p>
        <ol class="list-group list-group-numbered list-group-flush">
            <li class="list-group-item list-group-item-success">
                rellenar partes
            </li>
            <li class="list-group-item list-group-item-success">
                ver tareas pendientes
            </li>
            <li class="list-group-item list-group-item-success">
                ver tareas realizadas
            </li>
            <li class="list-group-item list-group-item-success">
                descargar manuales
            </li>
        </ol>

    @endsection