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
    <p>Estimado/a {{ Str::ucfirst($detalles['nombre']) }}, <br>
        Le comunicamos que ya hemos tramitado el registro de la incidencia. <br>
        Se ha asignado a uno de nuestros técnicos disponbles y lo resolverá lo antes posible.
    <p>Si tiene alguna duda o indicación adicional no dude en volver a contactarnos llamando de nuevo o respondiendo a este correo.</p>
    <p>Un saludo, <br>
        Ascensores Igobide</p>
</body>
</html>
