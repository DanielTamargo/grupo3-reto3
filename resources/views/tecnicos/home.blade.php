@extends('layouts.tecnico')

@section('title')
Home
@endsection

@section('content')
    <div class="m-1 p-2 bg-success">
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

        <p>la funcionalidad para poder pedir piezas llegara pronto</p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit facilis optio tempore magni, nobis, vel repellendus ipsa minus dignissimos tempora rerum laudantium voluptas numquam explicabo quod, quibusdam animi aspernatur ratione.
    </div>
@endsection