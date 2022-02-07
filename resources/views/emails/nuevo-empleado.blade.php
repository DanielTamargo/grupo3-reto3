<!DOCTYPE html>
<html>
<head>
    <title>Igobide</title>

    <style>
        h1.titulo { color: rgb(0, 88, 139); }
        p { color: #2f2f2f }
    </style>
</head>
<body>
    <h1 class="titulo">Ascensores Igobide</h1>
    <p>Saludos {{ Str::ucfirst($detalles['nombre']) }}, <br>
        Te comunicamos que tu usuario ya ha sido registrado en nuestra página web.</p>
    <p>Estas serán tus credenciales: <br>
        Usuario: <b>{{ $detalles['usuario'] }}</b><br>
        Contraseña: <b>{{ $detalles['password'] }}</b></p>
    <p>Puedes inciar sesión en el siguiente enlace: <br>
        {{ route('login') }}</p>
    <p>Si hubiera cualquier inconveniente no dude en contactar con nosotros respondiendo a este mismo correo.</p>
    <p>Un saludo, <br>
        Ascensores Igobide</p>
</body>
</html>
