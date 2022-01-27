<?php /*
    vista de las tareas que va a tener el tecnico
*/?>
@extends('layouts.tecnico')

@section('title')
Tareas
@endsection

@section('content')
    <p class="display-5">Tareas pendientes</p>
    <ul class="list-group">
        <!-- despues blade generara los item de esta lista.

        posible que las tareas tengan un codigo de color dependiendo de 
        su prioridad / que aparezcan primero-->
        <li class="list-group-item">esto es una tarea</li>
        <li class="list-group-item">esto es una tarea</li>
        <li class="list-group-item">esto es una tarea</li>
        <li class="list-group-item">esto es una tarea</li>
        <li class="list-group-item">esto es una tarea</li>
    </ul>
@endsection