<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    /**
     * Devuelve los ascensores que se basan en dicho modelo
     */
    public function ascensores() {
        return $this->hasMany(Ascensor::class);
    }
}
