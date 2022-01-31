<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ascensor extends Model
{
    use HasFactory;

    protected $table = "ascensores";

    /**
     * Devuelve el modelo relacionado
     */
    public function modelo() {
        return $this->belongsTo(Modelo::class, 'modelo_id', 'id');
    }

    /**
     * Devuelve sus tareas asociadas
     */
    public function tareas() {
        return $this->hasMany(Tarea::class, 'ascensor_ref', 'num_ref');
    }
}
