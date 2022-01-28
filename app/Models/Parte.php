<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parte extends Model
{
    use HasFactory;

    /**
     * Devuelve la tarea asociada al parte
     */
    public function tarea() {
        return $this->belongsTo(Tarea::class, 'tarea_id', 'id');
    }

    /**
     * Devuelve el tecnico que generó el parte
     */
    public function tecnico() {
        return $this->belongsTo(Tecnico::class, 'tecnico_codigo', 'codigo');
    }
}
