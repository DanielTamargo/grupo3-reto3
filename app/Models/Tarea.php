<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    // Para permitir guardar nuevos datos
    protected $fillable = [
        'fecha_creacion', 'fecha_finalizacion', 'descripcion',
        'tipo', 'estado', 'prioridad', 'ascensor_ref', 'cliente_id', 
        'operador_codigo', 'tecnico_codigo'
    ];

    /**
     * Devuelve el ascensor del cual surgió la tarea
     */
    public function ascensor() {
        return $this->belongsTo(Modelo::class, 'ascensor_ref', 'num_ref');
    }

    /**
     * Devuelve el cliente que solicitó la tarea
     */
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    /**
     * Devuelve el técnico asociado a la tarea
     */
    public function tecnico() {
        return $this->belongsTo(Tecnico::class, 'tecnico_codigo', 'codigo');
    }

    /**
     * Devuelve el operador que asignó la tarea
     */
    public function operador() {
        return $this->belongsTo(Operador::class, 'operador_codigo', 'codigo');
    }

    /**
     * Devuelve sus partes asociados
     */
    public function partes() {
        return $this->hasMany(Parte::class, 'tarea_id', 'id');
    }
}
