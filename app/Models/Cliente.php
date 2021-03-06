<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Para permitir guardar nuevos datos
    protected $fillable = [
        'nombre', 'email'
    ];

    /**
     * Devuelve sus tareas asociadas
     */
    public function tareas() {
        return $this->hasMany(Tarea::class, 'cliente_contacto', 'id');
    }
}
