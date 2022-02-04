<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    // Para permitir guardar nuevos datos
    protected $fillable = [
        'nombre', 'num_puertas', 'peso_max',
        'num_personas', 'llave', 'prioridad', 
        'tipoaccionamiento', 'manual', 
    ];

    /**
     * Devuelve los ascensores que se basan en dicho modelo
     */
    public function ascensores() {
        return $this->hasMany(Ascensor::class, 'modelo_id', 'id');
    }
}
