@extends('layouts.tecnico')

@section('title')
Parte
@endsection

@section('content')
    <div class="m-1 p-2 bg-success">
        <form action="" method="POST">
            <label for="id" class="form-label">Identificador de tarea:</label>
            <input type="text" name="idtarea" id="id" class="form-control">
            <label for="est" class="form-label">Estado</label>
            <select name="estado" id="est" class="form-select">
                <!-- posibles estados -->
                <option value="">solucionado</option>
                <option value="">en espera de piezas</option>
                <option value="">en espera de personal</option>
                <option value="">fuera de servicio</option>
            </select>
            <label for="anot" class="form-label">Ovservaciones:</label>
            <textarea name="anotacion" id="anot" cols="30" rows="10" class="form-control"></textarea>
            <input type="submit" value="finalizar">
        </form>
    </div>
@endsection