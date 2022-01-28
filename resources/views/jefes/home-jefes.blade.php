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
            <button type="button" class="btn btn-outline-light" ><a href="{{ route('estadisticas.show') }}" class="text-decoration-none">Ver estad&iacute;sticas</a></button>
            <button type="button" class="btn btn-outline-light"><a href=" {{ route('usuarios.create') }}" class="text-decoration-none">Alta de usuarios</a></button>
            <button type="button" class="btn btn-outline-light"><a href=" {{ route('usuarios.borrar.create') }}" class="text-decoration-none">Baja de usuarios</a></button>
            <button type="button" class="btn btn-outline-light"><a href=" {{ route('usuarios.modificar.create') }}" class="text-decoration-none">Modificar usuarios</a></button>
            <button type="button" class="btn btn-outline-light"><a href=" {{ route('manuales.create') }}" class="text-decoration-none">Subir manuales</a></button>
            <button type="button" class="btn btn-outline-light"><a href=" {{ route('historial.create') }}" class="text-decoration-none">Ver el historial</a></button>
        </form>
    </div>
</div>

</div>
@endsection