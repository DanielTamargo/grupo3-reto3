<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Igobide | Login</title>

    {{-- Icono página --}}
    <link rel="icon" href="{{ asset('/img/logo_peque.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

</head>
<body class="bg-dark text-black">
    @if ($errors->has('login_failed'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast'
                },
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            })
            Toast.fire({
                icon: 'error',
                title: 'Credenciales incorrectas'
            })
        </script>
    @endif

    <div class="login-container bg-dark">
        <main class="login_card">
            <div class="login_card_title">
                <h3 class="text-muted text-center mb-4">Ascensores Igobide</h3>
            </div>
            <div class="login_card_content">
                <div class="login_card_logo">
                    <img src="{{ asset('img/logoIgobideGrande_negro.png') }}" alt="Igobide">
                </div>
                <form method="POST" action="{{ route('login') }}" class="login_form">
                    @csrf
                    <input required type="text" name="username" id="usuario" class="lf_input lf_input_text" placeholder="Usuario">
                    <input required type="password" name="password" id="password" class="lf_input lf_input_text" placeholder="Contraseña">
                    <input type="submit" value="Iniciar sesión" class="lf_input lf_input_submit">
                </form>
            </div>
        </main>
    </div>
</body>
</html>
