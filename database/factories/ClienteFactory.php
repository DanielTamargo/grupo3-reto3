<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use \App\Models\Enums\TiposTareas;
use \App\Models\Enums\EstadosTareas;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre = $this->faker->firstName();
        $apellido = $this->faker->lastName();

        return [
            'email' => strtolower($nombre) . "." . strtolower($apellido) . "@" . $this->faker->domainName(),
            'nombre' => "$nombre $apellido"
        ];
    }
}
