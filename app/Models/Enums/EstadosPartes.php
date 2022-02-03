<?php

namespace App\Models\Enums;

enum EstadosPartes: string {
    case SINTRATAR = "sintratar";
    case RETRASADO = "retrasar";
    case IMPOSIBLESOLUCIONAR = "imposiblesolucionar";
    case MATERIALNECESARIO = "materialnecesario";
    case FINALIZADO = "finalizado";
}

?>
