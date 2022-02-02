@extends('layouts.app2')

@section('title')
Login
@endsection

@section("maincontent")
    <style>
        header div p {
            font-family: 'Roboto', sans-serif;
        }
        #contentcontainer > * {
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
    <div class="col-12 text-center">
        <main class="row h-100" id="contentcontainer">
            <form action="" method="POST" class="p-5 col">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <input type="text" name="user" id="usr" class="form-control my-2 rounded-pill bg-dark text-white" placeholder="Usuario">
                        <input type="password" name="pass" id="pass" class="form-control my-2 rounded-pill bg-dark text-white" placeholder="Contraseña">
                    </div>
                </div>
                <input type="submit" value="Iniciar sesion" class="btn btn-outline-light btn-lg mt-2">
            </form>
        </main>
        
    </div>
@endsection