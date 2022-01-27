@extends('layouts.app')
@section('content')

        <div class="col-12 h-100 d-flex flex-column justify-content-center align-items-center ">

            <div class="row ">
                <div class="col-12">
                    <h2>Bienvenido! </h2> <!--cuando tengamos las vistas relacionadas poner el nombre de usuario!-->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <p>¿Qué quieres hacer?</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="" method="get">
                        <button type="button" class="btn btn-outline-light" ><a href="{{ route('nuevaAveria.create') }}" class="text-decoration-none">Nueva Aver&iacute;a</a></button>
                        <button type="button" class="btn btn-outline-light"><a href=" {{ route('crearParte.create') }}" class="text-decoration-none">Crear Parte</a></button>
                        <button type="button" class="btn btn-outline-light"><a href=" {{ route('ultimasRevisiones.show') }}" class="text-decoration-none">Ver &Uacute;ltimas Revisiones</a></button>
                        <button type="button" class="btn btn-outline-light"><a href=" {{ route('asignarRevisiones.create') }}" class="text-decoration-none">Asignar Nuevas Revisiones</a></button>
                    </form>
                </div>
            </div>

        </div>

@endsection