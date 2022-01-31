<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JefeEquipo extends Model
{
    use HasFactory;

    // Nombre de tabla personalizado (debido al plural)
    protected $table = "jefes_equipos";

    // No utilizamos un id autoincremental, por lo que personalizamos la clave primaria
    protected $primaryKey = 'codigo';
    protected $keyType = 'string';

    // Incrementing false para que inserte bien la clave ya que es string, ojo ¡Tiene que ser public!
    public $incrementing = false;

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
