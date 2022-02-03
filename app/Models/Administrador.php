<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    // Nombre de tabla personalizado (debido al plural)
    protected $table = "administradores";

    // No utilizamos un id autoincremental, por lo que personalizamos la clave primaria
    protected $primaryKey = 'codigo';
    protected $keyType = 'string';

    // Incrementing false para que inserte bien la clave ya que es string, ojo ¡Tiene que ser public!
    public $incrementing = false;

    // Para permitir guardar nuevos datos
    protected $fillable = ['user_id', 'codigo'];

    /**
     * Devuelve el usuario relacionado
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
