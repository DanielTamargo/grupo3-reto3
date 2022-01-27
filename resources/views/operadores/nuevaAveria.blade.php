@extends('layouts.app')
@section('content')
<div class="col-12 d-flex flex-column justify-content-center align-items-center">

    <div class="row">
        <div class="col-12">
            <h2>Nueva Averia</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="" method="post">

                <div class="row">
                    <div class="col-12">
                        <input type="text" name="ref" placeholder=" Referencia/Dirección" class="form-control rounded-pill mt-2" id="ref"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="tel" name="cliente_contacto" placeholder=" Número de cliente" class="form-control rounded-pill mt-2" id="cliente_contacto"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="text" name="operador" placeholder=" Nombre del operador" class="form-control rounded-pill mt-2" id="operador"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="text" name="tecnico" placeholder=" Nombre Técnico" class="form-control rounded-pill mt-2" id="tecnico"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="text" name="tipo" placeholder=" Tipo de averia" class="form-control rounded-pill mt-2" id="tipo"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <textarea name="descripcion" id="descripcion" cols="50" rows="10" placeholder=" Descripción" class="form-control rounded-pil mt-2"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-light"><a href="#" class="text-decoration-none">Añadir</a></button>
                    </div>
                </div>
       
            </form>
        </div>
    </div>
</div>
@endsection