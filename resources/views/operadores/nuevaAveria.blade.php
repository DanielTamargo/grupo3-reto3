@extends('layouts.app')
@section('content')

<div class="col-12 d-flex flex-column justify-content-center align-items-center">
    <div class="row">
        <div class="col-12">
            <h2>Nueva Averia</h2>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <form action="" method="post">
            @csrf
                <div class="row">
                    <div class="col-12">
                        <input type="text" name="ref" placeholder=" Referencia/Dirección" class="form-control rounded-pill mt-2 bg-dark text-white" id="ref"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="tel" name="cliente_contacto" placeholder=" Número de cliente" class="form-control rounded-pill mt-2 bg-dark text-white" id="cliente_contacto"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="text" name="operador" placeholder=" Nombre del operador" class="form-control rounded-pill mt-2 bg-dark text-white" id="operador"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <select id="listaTecnico" class="col-12 mt-2 rounded-pill bg-dark text-white text-center">
                            <option id="t1" value="t1">Tecnico 1</option>
                            <option value="t2">Tecnico 2</option>
                            <option value="t3">Tecnico 3</option>
                            <option value="t4">Tecnico 4</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="text" name="tipo" placeholder=" Tipo de averia" class="form-control rounded-pill mt-2 bg-dark text-white" id="tipo"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <textarea name="descripcion" id="descripcion" cols="50" rows="10" placeholder=" Descripción" class="form-control rounded mt-2 bg-dark text-white"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex mt-2 justify-content-center bg-dark ">
                        <button type="submit" class="btn btn-outline-light"><a href="#" class="text-decoration-none">Añadir</a></button>
                    </div>
                </div>
       
            </form>
        </div>
    </div>
</div>
@endsection