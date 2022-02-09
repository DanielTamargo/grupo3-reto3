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
<body class="container-fluid text-black bg-gris3">
    <header class="row bg-azul1 align-items-center justify-content-between">
        <div class="col-3 col-md-2 row align-items-center">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/img/logo_peque.png') }}" alt="" class="img-fluid w-50 d-block"/>
            </a>
        </div>
        <div class="col-4 col-md-3 row align-items-center justify-content-end">
            <a class="navbar-brand d-flex justify-content-end" href="#menu" onclick="menu()">
                <img src="{{ asset('/img/icono-menu.png') }}" alt="" class="img-fluid w-50 d-block"/>
            </a>
        </div> 
    </header>
    <div class="row pt-2" id="maincontainer">
        @yield('maincontent')
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function menu() {
            Swal.fire({
                title: 'Selecciona una acción',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Volver',
                cancelButtonText: 'Perfil',
                denyButtonText: 'Logout',
            }).then((result) => {
                if (result.isCanceled) {
                    location.location.href = "#perfil";
                } else if (result.isDenied) {
                    window.location.href = "#logout";
                }
            });
        }
    </script>
</body>
</html>