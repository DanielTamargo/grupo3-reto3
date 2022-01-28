@extends('layouts.app')
@section('content')
<div class="col-2 d-flex justify-content-start">
    <button type="button" class="btn btn-outline-light"><a href="{{ route('home.operador') }}" class="text-decoration-none"> Volver al inicio</a></button>
</div>

<div class="col-12 d-flex flex-column justify-content-center align-items-center">
    <div class="row">
        <div class="col-12">
            <h2>Revisiones anteriores</h2>
        </div>
    </div>

<div class="row mt-5">
    <div class="col-12">
        <table class="table table-striped text-center">
            <thead>
                <tr class="table-light">
                    <th scope="col">Id Ascensor</th>
                    <th scope="col">Direcci&oacute;n</th>
                    <th scope="col">T&eacute;nico asignado</th>
                    <th scope="col">Fecha &uacute;ltima revisi&oacute;n</th>
                    <th scope="col">Fecha Siguiente revisi&oacute;n</th>
                </tr>
            </thead>

            <tbody>
                <tr class="table-light">
                    <td class="table-light">1</td>
                    <td class="table-light">Direccion1</td>
                    <td class="table-light">Tecnico1</td>
                    <td class="table-light">11/11/2011</td>
                    <td class="table-light">23/09/2012</td>
                </tr>
                <tr>
                    <td class="table-light">2</td>
                    <td class="table-light">Direcion2</td>
                    <td class="table-light">Tecnico2</td>
                    <td class="table-light">12/12/12</td>
                    <td class="table-light">12/12/12</td>
                </tr>
                <tr>
                    <td class="table-light">3</td>
                    <td class="table-light">Direccion3</td>
                    <td class="table-light">Tecnico3</td>
                    <td class="table-light">33/33/3333</td>
                    <td class="table-light">33/33/3333</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection