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
    <style>
        header.cabecera {
            height: 70px;
            max-height: 70px;
        }
        header.cabecera > div {
            height: 100%;
            padding: 10px;
        }
        header.cabecera > div > a > img {
            max-width: 100%;
        }
    </style>
</head>
<body class="container-fluid text-black bg-gris3">
    <header class="cabecera row bg-azul1 align-items-center justify-content-between">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <a class="navbar-brand ms-3" href="{{ url('/') }}">
                <img src="{{ asset('/img/logo_peque.png') }}" alt="" class="img-fluid w-50 d-block"/>
            </a>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <ul class="navbar-nav ms-auto me-3">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->nombre }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="{{ route('empleados.show', ["user_id" => Auth::user()->id]) }}">Editar Perfil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <div class="row pt-2" id="maincontainer">
        @yield('maincontent')
    </div>
</body>
</html>
