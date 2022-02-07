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
    <p>Te ha sido asignada una nueva tarea</p>

    <p>Puedes consultar su información en el siguiente enlace: <br>
        {{ route('tecnico.show') }}</p>

    <p>Si hubiera cualquier inconveniente no dude en contactar con su jefe de equipo o con nosotros respondiendo a este mismo correo.</p>
    <p>Un saludo, <br>
        Ascensores Igobide</p>
</body>
</html>
