@extends('layouts.app')
@section('content')
<div class="col-2 d-flex justify-content-start">
    <button type="button" class="btn btn-outline-light"><a href="{{ route('home.jefe') }}" class="text-decoration-none"> Volver al inicio</a></button>
</div>

<div class="col-12 d-flex flex-column justify-content-center align-items-center">

    <div class="row">
        <div class="col-12">
            <h2>Nuevos Usuarios</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="" method="post">
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
            </form>
        </div>
    </div>
</div>
@endsection