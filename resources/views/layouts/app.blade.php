<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Icono página --}}
    <link rel="icon" href="{{ asset('/img/logo_peque.png') }}">

    @php
        $titulo = config('app.name', 'Igobide');
    @endphp
    <title>@yield('title', $titulo)</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if (isset($home))
    <style>
        body{
            background:linear-gradient(360deg,rgba(165, 94, 234,0.5),rgba(116, 185, 255,0.7));
        }
    </style>
    @endif
</head>
<body class="bg-dark text-black" style="height: 100vh;" >
    <div id="app" class="container-fluid h-100" >
        <div class="row">
            <nav class="navbar navbar-expand-sm navbar-light bg-primary shadow-sm gx-0">
                <div class="container-fluid bg-primary px-4">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('/img/logoIgobideGrande_negro.png') }}" alt="" class="img-fluid w-50 d-none d-md-block"/>
                        <img src="{{ asset('/img/logo_peque.png') }}" alt="" class="img-fluid w-50 d-md-none d-block"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Navbar parte izquierda -->
                        <ul class="d-sm-inline-block navbar-nav me-auto">
                            @if(Auth::user()->rol == 'administrador')
                                <div class="navegador d-flex">
                                    <a class="nav-link mx-1" href="{{ route('empleados.index') }}">Empleados</a>
                                    <a class="mx-1 nav-link" href="{{ route('ascensores.index') }}">Ascensores</a>
                                    <a class="mx-1 nav-link" href="{{ route('tareas.index') }}">Tareas</a>
                                </div>
                            @elseif(Auth::user()->rol == 'operador')
                                <div class="navegador d-flex">
                                    <a class="mx-1 nav-link"  href="{{route('nuevatarea.create')}}">Nueva tarea</a>
                                    <a class="mx-1 nav-link"  href="{{route('tareas.index')}}">Tareas</a>
                                    <a class="mx-1 nav-link"  href="{{route('ascensores.index')}}">Ascensores</a>
                                </div>
                            @elseif(Auth::user()->rol == 'jefeequipo')
                                <div class="navegador d-flex">
                                    <a class="mx-1 nav-link"  href="{{route('estadisticas.create')}}">Estadisticas</a>
                                    <a class="mx-1 nav-link"  href="{{route('empleados.index')}}">Usuarios</a>
                                    <a class="mx-1 nav-link"  href="{{route('ascensores.index')}}">Ascensores</a>
                                </div>
                            @endif
                        </ul>

                        <!-- Navbar parte derecha -->
                        <ul class="d-sm-inline-block navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                </div>
            </nav>
        </div>
        <main class="py-4 row h-75">
            @yield('content')
        </main>
    </div>
</body>
</html>
