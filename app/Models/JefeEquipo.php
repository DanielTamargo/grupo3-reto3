<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JefeEquipo extends Model
{
    use HasFactory;

    protected $table = "jefes_equipos";

    /**
     * Devuelve el usuario relacionado
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Devuelve sus técnicos asignados a su equipo
     */
    public function tecnicos() {
        return $this->hasMany(Tecnico::class, 'jefe_codigo', 'codigo');
    }
}
