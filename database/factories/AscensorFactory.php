<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AscensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Se generan fechas de instalación aleatorias desde 1 de Enero de 1990 hasta hace 7 días
        $fecha_instalacion = new DateTime();
        $fecha_instalacion->setTimestamp($this->faker->numberBetween(946688461, time() - (7 * 24 * 60 * 60)));

        return [
            'num_ref' => Str::random(10),
            'ubicacion' => $this->faker->address(),
            'num_plantas' => $this->faker->numberBetween(2, 8),
            'fecha_instalacion' => $fecha_instalacion,
            'fecha_ultima_revision' => $fecha_instalacion // <- se actualizarán más adelante
        ];
    }
}
