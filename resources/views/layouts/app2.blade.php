<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- layout principal para las vistas de tecnicos -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- enlace al js -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- enlace a los estilos bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="container-fluid min-vh-100 text-black bg-gris3">
    <header class="row bg-azul1">
        <div class="col-3 col-md-2">
            <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="./img/logoIgobideGrande_negro.png" alt="logo_grande" class="img-fluid w-50 d-none d-md-block"/>
                    <img src="./img/logo_peque.png" alt="logo" class="img-fluid w-50 d-md-none d-block"/>
            </a>
        </div>
        <div class="col">
            <p class="display-5 mt-3">Ascensores igobide</p>
        </div>
    </header>
    <div class="row pt-2" id="maincontainer">
        @yield('maincontent')
    </div>
</body>
</html>