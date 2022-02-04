@extends('layouts.app')
@section('content')
<div class="col-12 h-75 d-flex flex-column justify-content-center align-items-center">
    <div class="row">
        <div class="col-12">
            <h2>Borrar Usuario</h2>
        </div>

        <!-- con un foreach mostrar todos los usuarios y con un checkbox seleccionarlo y al dar a aceptar se borrara -->
        <div class="row">
            <div class="col-8 ">
                <form action="" method="post" class="d-flex flex-column justify-content-center align-items-center">
                <div class="form-check row">
                @csrf
                    <input class="form-check-input col-6" type="checkbox" value="u1" id="flexCheckDefault">
                    <label class="form-check-label col-6" for="flexCheckDefault">Usuario1</label>
                </div>
                <div class="form-check row">
                    <input class="form-check-input col-6" type="checkbox" value="u2" id="flexCheckChecked">
                    <label class="form-check-label col-6" for="flexCheckChecked">Usuario2</label>
                </div>
                <div class="form-check row">
                    <input class="form-check-input col-6" type="checkbox" value="u3" id="flexCheckChecked">
                    <label class="form-check-label col-6" for="flexCheckChecked">Usuario3</label>
                </div>
                <div class="form-check row">
                    <input class="form-check-input  col-6" type="checkbox" value="u4" id="flexCheckChecked">
                    <label class="form-check-label col-6" for="flexCheckChecked">Usuario4</label>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-light text-black">Eliminar</button>
                    </div>
                </div>
                </form>
               
            </div>
        </div>
    </div>
</div>
@endsection