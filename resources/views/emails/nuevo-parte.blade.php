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
        Nuestro técnico asignado ya ha asistido a la incidencia. <br>
        @if ($detalles['estado'] == 'finalizado')
            Ha indicado la incidencia como resulta por lo que esperamos que todo funcione correctamente.
        @elseif ($detalles['estado'] == 'materialrequerido')
            Ha determinado que se necesita material adicional para la reparación por lo que la incidencia sigue activa y sin cerrar. Le notificaremos futuros cambios.
        @elseif ($detalles['estado'] == 'imposiblesolucionar')
            Ha determinado la avería como insoluble, por lo que el caso será traspasado al departamento de gestión e instalaciones, quienes se encargarán de analizar la situación y asesorar adecuadamente.
        @else
            Debido a circustancias desafortunadas no ha podido finalizar la tarea satisfactoriamente por lo que volverá a acudir lo antes posible.
        @endif
    <p>Si tiene alguna duda o indicación adicional no dude en volver a contactarnos llamando de nuevo o respondiendo a este correo.</p>
    <p>Un saludo, <br>
        Ascensores Igobide</p>
</body>
</html>
