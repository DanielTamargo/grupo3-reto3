@extends('layouts.app')
@section('content')


<div class="col-12 h-75 d-flex flex-column justify-content-center align-items-center">

    <div class="row">
        <div class="col-12">
            <h2>Nuevos Usuarios</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="" method="post" autocomplete="off">
            @csrf
                <div class="row">
                        <div class="col-12">
                            <div class="row">
                                    <div class="col-12">
                                        <label for="rol">¿Qué tipo de usuario quieres insertar?</label>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-12">
                                        <select id="listaRoles" class="col-12 mt-2 rounded-pill bg-dark text-black text-center">
                                            <option id="tecnico" value="tecnico">T&eacute;cnico</option>
                                            <option id="operario" value="operario">Operario</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="nombre" id="nombre" placeholder=" Nombre" class=" form-control mt-2 bg-dark text-black rounded-pill"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="apellido" id="apellido" placeholder=" Apellido" class=" form-control mt-2 bg-dark text-black rounded-pill"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="tel" name="telefono" id="telefono" placeholder=" Telefono" class=" form-control mt-2 bg-dark text-black rounded-pill"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="email" name="email" id="email" placeholder=" Email" class=" form-control mt-2 bg-dark text-black rounded-pill"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-outline-light text-black">Aceptar</button>
                                </div>
                            </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection