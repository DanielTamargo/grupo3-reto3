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
            <a href="{{ route('estadisticas.show') }}" class="btn btn-outline-light text-decoration-none text-black">Ver estad&iacute;sticas</a>
            <a href=" {{ route('usuarios.create') }}" class="btn btn-outline-light text-decoration-none text-black">Alta de usuarios</a>
            <a href=" {{ route('usuarios.borrar.create') }}" class="btn btn-outline-light text-decoration-none text-black">Baja de usuarios</a>
            <a href=" {{ route('usuarios.modificar.create') }}" class="btn btn-outline-light text-decoration-none text-black">Modificar usuarios</a>
            <a href=" {{ route('manuales.create') }}" class="btn btn-outline-light text-decoration-none text-black">Subir manuales</a>
            <a href=" {{ route('historial.create') }}" class="btn btn-outline-light text-decoration-none text-black">Ver el historial</a>
        </form>
    </div>
</div>

</div>
@endsection