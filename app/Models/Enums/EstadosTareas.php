<?php

namespace App\Models\Enums;

enum EstadosTareas: string {
    case SINTRATAR = "sintratar";
    case RETRASADO = "retrasado";
    case IMPOSIBLESOLUCIONAR = "imposiblesolucionar";
    case MATERIALNECESARIO = "materialnecesario";
    case FINALIZADO = "finalizado";
}

?>
