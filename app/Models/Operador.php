<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    use HasFactory;

    protected $table = "operadores";

    /**
     * Devuelve el usuario relacionado
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Devuelve las tareas que ha generado
     */
    public function tareas() {
        return $this->hasMany(Tarea::class);
    }
}
