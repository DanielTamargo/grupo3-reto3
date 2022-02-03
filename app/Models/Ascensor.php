<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ascensor extends Model
{
    use HasFactory;

    // Nombre de tabla personalizado (debido al plural)
    protected $table = "ascensores";

    // No utilizamos un id autoincremental, por lo que personalizamos la clave primaria
    protected $primaryKey = 'num_ref';
    protected $keyType = 'string';

    // Para permitir guardar nuevos datos
    protected $fillable = [
        'num_ref', 'ubicacion', 'modelo_id',
        'num_plantas', 'fecha_instalacion', 'fecha_ultima_revision', 
    ];

    // Incrementing false para que inserte bien la clave ya que es string, ojo ¡Tiene que ser public!
    public $incrementing = false;
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
