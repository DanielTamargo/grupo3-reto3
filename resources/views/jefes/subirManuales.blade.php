@extends('layouts.app')
@section('content')
<div class="col-12 d-flex flex-column justify-content-center align-items-center">
    <div class="row">
        <div class="col-12">
            <h2>Submir manuales</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="" method="post">
            @csrf
                <div class="row">
                    <div class="col-12">
                        <input type="file" name="manual" id="manual"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-2 d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-light text-black">Subir manual</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection