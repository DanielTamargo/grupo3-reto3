<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'rol',
        'email',
        'telefono',
        'dni',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Devuelve la entidad asociada al usuario, sea operador, tecnico, jefedeequipo o administrador
     */
    public function puesto() {
        // Dependiendo del rol que tenga el usuario, su entidad puesto será una u otra
        if ($this->attributes['rol'] == "operador") return $this->hasOne(Operador::class, 'user_id', 'id');
        if ($this->attributes['rol'] == "jefeequipo") return $this->hasOne(JefeEquipo::class, 'user_id', 'id');
        if ($this->attributes['rol'] == "tecnico") return $this->hasOne(Tecnico::class, 'user_id', 'id');
        if ($this->attributes['rol'] == "administrador") return $this->hasOne(Administrador::class, 'user_id', 'id');


        // Si no encuentra ninguno, devuelve un técnico (que no existirá y devolverá un objeto nulo o vacío)
        return $this->hasOne(Tecnico::class);
    }
}
