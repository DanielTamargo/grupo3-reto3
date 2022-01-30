<?php

namespace App\Models\Enums;

enum Roles: string {
    case ADMINISTRADOR = "administrador";
    case JEFEEQUIPO = "jefeequipo";
    case TECNICO = "tecnico";
    case OPERADOR = "operador";
}

?>
