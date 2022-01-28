<!DOCTYPE html>
<html lang="en">
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:wght@500&family=Ubuntu&display=swap');
        #maincontainer {
            min-height: 85vh;
        }
    </style>
</head>
<body class="container-fluid min-vh-100">
    <header class="row bg-primary">
        <div class="col-3 col-md-2">
            <img src="" alt="logo" class="img-fluid m-auto">
            
        </div>
        <div class="col">
            <p class="display-5 mt-3">Ascensores igobide</p>
        </div>
    </header>
    <div class="row py-2" id="maincontainer">
        @yield('maincontent')
    </div>
    <footer class="row bg-warning">
        <div class="col">
            &copy;footer
        </div>
    </footer>
</body>
</html>