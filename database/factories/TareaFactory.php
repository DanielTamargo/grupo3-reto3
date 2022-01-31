<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use \App\Models\Enums\TiposTareas;
use \App\Models\Enums\EstadosTareas;

class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cliente = \App\Models\Cliente::factory(1)->create()[0];

        $random = rand(0, 3);
        $tipo = TiposTareas::INCIDENCIA;
        if ($random == 2) $tipo = TiposTareas::AVERIA;
        else if ($random == 3) $tipo = TiposTareas::REVISION;

        $estado = EstadosTareas::SINTRATAR;

        $prioridad = $this->faker->numberBetween(0, 5);
        if ($prioridad == 5) $tipo = TiposTareas::AVERIA;

        return [
            'descripcion' => $this->faker->realText(100),
            'prioridad' => $prioridad,
            'tipo' => $tipo,
            'estado' => $estado,
            'cliente_id' => $cliente->id
        ];
    }
}
