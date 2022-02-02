@extends('layouts.app')
@section('content')
<div class="col-12 d-flex flex-column justify-content-center align-items-center">
    <div class="row">
        <div class="col-12">
            <h2>Modificar Usuarios</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">  
            <form action="" method="post">
             @csrf
                    <div class="row">
                        <div class="col-12">
                            <select id="usuarios" class="col-12 mt-2 rounded-pill bg-dark text-black text-center">
                                <option id="u1" value="u1">Usuario1</option>
                                <option id="u2" value="u2">Usuario2</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <select id="roles" class="col-12 mt-2 rounded-pill bg-dark text-black text-center">
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
                            <button type="submit" class="btn btn-outline-light text-black">Modificar</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection