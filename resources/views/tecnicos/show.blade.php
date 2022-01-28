<?php /*
    vista de las tareas que va a tener el tecnico
*/?>
@extends('layouts.tecnico')

@section('title')
Tareas
@endsection

@section('content')
    <p class="display-5">Tareas pendientes</p>
    <div class="accordion">
        <!-- despues blade generara los item de esta lista.

        posible que las tareas tengan un codigo de color dependiendo de 
        su prioridad / que aparezcan primero-->
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                    esto es una tarea
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <p><b>direccion:</b> direccion</p>
                    <p><b>datos:</b> aqui informacion</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                esto es una tarea
            </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    <p><b>direccion:</b> direccion</p>
                    <p><b>datos:</b> aqui informacion</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                esto es una tarea
            </button>
            </h2>
            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                <div class="accordion-body">
                    <p><b>direccion:</b> direccion</p>
                    <p><b>datos:</b> aqui informacion</p>
                </div>
            </div>
        </div>
    </div>
@endsection