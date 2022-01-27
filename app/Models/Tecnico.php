<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;

    /**
     * Devuelve el usuario relacionado
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Devuelve su jefe de equipo
     */
    public function jefe() {
        return $this->belongsTo(JefeEquipo::class, 'jefe_codigo', 'codigo');
    }

    /**
     * Devuelve sus tareas asignadas
     */
    public function tareas() {
        return $this->hasMany(Tarea::class);
    }

    /**
     * Devuelve sus partes realizados
     */
    public function partes() {
        return $this->hasMany(Parte::class);
    }
}
