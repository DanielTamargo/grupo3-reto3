@extends('layouts.app')
@section('content')

        <div class="col-12 h-75 d-flex flex-column justify-content-center align-items-center ">

            <div class="row ">
                <div class="col-12">
                    <h2>Bienvenido!{{Auth::user()->nombre}}</h2> <!--cuando tengamos las vistas relacionadas poner el nombre de usuario!-->
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
                        <a href="{{ route('nuevaaveria.create') }}" class="btn btn-outline-light text-black text-decoration-none">Nueva Aver&iacute;a</a>
                        <a href=" {{ route('crearparte.create') }}" class="btn btn-outline-light text-black text-decoration-none">Crear Parte</a>
                        <a href=" {{ route('ultimasrevisiones.show') }}" class="btn btn-outline-light text-black text-decoration-none">Ver &Uacute;ltimas Revisiones</a>
                        <a href=" {{ route('asignarrevisiones.create') }}" class="btn btn-outline-light text-black text-decoration-none">Asignar Nuevas Revisiones</a>
                        
                    </form>
                </div>
            </div>

        </div>

@endsection