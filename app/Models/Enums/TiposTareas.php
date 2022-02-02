<?php

namespace App\Models\Enums;

enum TiposTareas: string {
    case INCIDENCIA = "incidencia";
    case AVERIA = "averia";
    case REVISION = "revision";
}

?>
