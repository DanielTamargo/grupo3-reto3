<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;

    // No utilizamos un id autoincremental, por lo que personalizamos la clave primaria
    protected $primaryKey = 'codigo';
    protected $keyType = 'string';

    // Incrementing false para que inserte bien la clave ya que es string, ojo ¡Tiene que ser public!
    public $incrementing = false;

   // Para permitir guardar nuevos datos
   protected $fillable = ['user_id', 'codigo', 'jefe_codigo'];

    /**
     * Devuelve el usuario relacionado
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
        return $this->hasMany(Tarea::class, 'tecnico_codigo', 'codigo');
    }

    /**
     * Devuelve sus partes realizados
     */
    public function partes() {
        return $this->hasMany(Parte::class, 'tecnico_codigo', 'codigo');
    }
}
