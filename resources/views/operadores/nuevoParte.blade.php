@extends('layouts.app')
@section('content')


    <div class="col-12 d-flex flex-column justify-content-center align-items-center">

        <div class="row">
            <div class="col-12">
                <h2>Nuevo Parte</h2>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <form action="" method="post">
                @csrf
                    <div class="row">
                        <div class="col-12">
                        <select id="listaTecnico" class="col-12 mt-2 rounded-pill bg-azul1 text-white text-center">
                            <option id="t1" value="t1">Tecnico 1</option>
                            <option value="t2">Tecnico 2</option>
                            <option value="t3">Tecnico 3</option>
                            <option value="t4">Tecnico 4</option>
                        </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <input type="number" name="tarea" placeholder=" Tarea" id="tarea" class="form-control rounded-pill bg-azul1 mt-2 text-white"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                        <input type="text" name="estado" placeholder=" Estado de la averia" id="estado" class="form-control rounded-pill bg-azul1 mt-2 text-white"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                        <textarea name="anotacion" id="anotacion" placeholder=" Anotaciónes" cols="50"  rows="10" class="form-control rounded bg-azul1 mt-2 text-white"></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 mt-2 d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-light"><a href="#" class="text-decoration-none">Añadir</a></button>
                        </div>
                    </div>     
                       
                </form>
            </div>
        </div>
    </div>
@endsection