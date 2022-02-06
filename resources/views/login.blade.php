<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Igobide | Login</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .login-container {
            margin-top: 20vh;
            width: 100vw;
        }
        main.login_card {
            max-width: 400px;
            margin: 0 auto;
            width: 90vw;
            border: 1px solid #494949;
            box-shadow: 0 0 4px 2px #494949;
            background: radial-gradient(
                ellipse at left bottom,
                rgba(116, 186, 255, 0.281) 0%,
                #e1e4e8 62%,
                rgba(164, 94, 234, 0.267) 100%
            );

            height: fit-content;
            min-height: fit-content;

            padding: 2em;
        }
        .login_card_content {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-direction: row;
        }
        .login_card_logo {
            display: none;
        }
        .login_card_logo > img {
            width: 100%;
        }
        .login_form {
            max-width: 370px;
            height: fit-content;
        }
        .login_form > .lf_input_text {
            width: 100%;
            margin-bottom: 10px;
        }
        .login_form > .lf_input_submit {
            margin-top: 1em !important;
            display: block;
            margin: 0 auto;
        }
        .login_form > .lf_input {
            text-align: center;
            border-radius: 2px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 1px solid rgb(9, 132, 227);
            color: rgb(9, 132, 227);
        }
        .login_form > .lf_input:focus {
            outline: none !important;
            border-color: rgb(165, 94, 234);
            color: rgb(165, 94, 234);
            box-shadow: 0 0 2px 1px gray;
        }
        .login_form > .lf_input_submit:active {
            background-color: rgb(165, 94, 234);
            color: #fff;
            margin: 0 auto;
        }
        .login_form > .lf_input:not(:placeholder-shown) {
            color: rgb(165, 94, 234);
            border-color: rgb(165, 94, 234);
        }
        .lf_input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: rgb(144, 172, 196);
            opacity: 1; /* Firefox */
        }
        .lf_input:-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: rgb(144, 172, 196);
        }
        .lf_input::-ms-input-placeholder { /* Microsoft Edge */
            color: rgb(144, 172, 196);
        }
        .colored-toast.swal2-icon-error {
            background-color: #c26262 !important;
            color: white;
            font-weight: bold;
        }


        @media (min-width: 760px) {
            .login_card_logo {
                display: block;
            }
            .login_card {
                max-width: 684px !important;
            }
            .login_card_title {
                display: none;
            }
        }
    </style>
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
