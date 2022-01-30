<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use DateTime;

// Enums
use App\Models\Enums\Roles;
use App\Models\Enums\TiposAccionamientos;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->command->info("Starting Seeding. ");

        // Datos fijos
        // Administrador
        $dani = \App\Models\User::create([
            'nombre' => 'Daniel',
            'apellidos' => 'Tamargo Saiz',
            'email' => 'daniel.tamargo@ikasle.egibide.org',
            'email_verified_at' => now(),
            'telefono' => '648703215',
            'rol' => Roles::ADMINISTRADOR, // administrador, tecnico, operador, jefeequipo
            'dni' => '72831820C',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'abcdefghij',
        ]);
        $dani->save();

        $dani = \App\Models\Administrador::create([
            'codigo' => "adm_" . str_pad($dani->id, 5, "0", STR_PAD_LEFT),
            'user_id' => $dani->id
        ]);
        $dani->save();

        // -------------------------------------------------------------------------------------
        // DATOS FAKE ALEATORIOS
        // -------------------------------------------------------------------------------------
        // EQUIPOS (JEFE + TÉCNICOS)
        $this->command->line("Creando Equipos (Jefes de Equipo + Técnicos)");
        for ($i = 0; $i < 5; $i++) { // 5 Jefes de Equipo
            // Usuario jefe de equipo
            $jefeequipo = \App\Models\User::factory(1)->create(['rol' => Roles::JEFEEQUIPO])[0];
            // Entidad empleo JefeEquipo
            $jefeequipo = \App\Models\JefeEquipo::create([
                'codigo' => "jef_" .str_pad($jefeequipo->id, 5, "0", STR_PAD_LEFT),
                'user_id' => $jefeequipo->id
            ]);

            // Número de técnicos que tendrá asignado cada jefe
            $numTecnicos = random_int(1, 5);
            // Usuarios técnicos asignados al jefe
            $tecnicos = \App\Models\User::factory($numTecnicos)->create(['rol' => Roles::TECNICO]);
            // Entidades empleo Tecnico de cada técnico creado
            foreach($tecnicos as $tecnico) {
                \App\Models\Tecnico::create([
                    'codigo' => "tec_" .str_pad($tecnico->id, 5, "0", STR_PAD_LEFT),
                    'user_id' => $tecnico->id,
                    'jefe_codigo' => $jefeequipo->codigo,
                ])->save();
            }
        }
        $this->command->comment("Equipos creados con éxito");
        // -------------------------------------------------------------------------------------
        // OPERADORES
        $this->command->line("Creando Operadores");
        // Número de operadores
        $numOperadores = random_int(4, 8);
        // Usuarios operadores
        $operadores = \App\Models\User::factory($numOperadores)->create(['rol' => Roles::OPERADOR]);
        // Entidades empleo Operador de cada operador creado
        foreach($operadores as $operador) {
            \App\Models\Operador::create([
                'codigo' => "op_" .str_pad($operador->id, 5, "0", STR_PAD_LEFT),
                'user_id' => $operador->id,
            ])->save();
        }
        $this->command->comment("Operadores creados con éxito");
        // -------------------------------------------------------------------------------------
        // MODELOS
        $this->command->line("Creando Modelos");
        $modelos = [];
        array_push($modelos, \App\Models\Modelo::create(['nombre' => 'Modelo 1', 'num_puertas' => 1, 'peso_max' => 460, 'num_personas' => 4,
        'llave' => false, 'tipoaccionamiento' => TiposAccionamientos::HIDRAULICO, 'manual' => 'manual_1.pdf']));
        array_push($modelos,\App\Models\Modelo::create(['nombre' => 'Modelo 2', 'num_puertas' => 1, 'peso_max' => 340, 'num_personas' => 3,
        'llave' => false, 'tipoaccionamiento' => TiposAccionamientos::HIDRAULICO, 'manual' => 'manual_1.pdf']));
        array_push($modelos, \App\Models\Modelo::create(['nombre' => 'Modelo 3', 'num_puertas' => 2, 'peso_max' => 420, 'num_personas' => 4,
        'llave' => false, 'tipoaccionamiento' => TiposAccionamientos::HIDRAULICO, 'manual' => 'manual_1.pdf']));
        array_push($modelos, \App\Models\Modelo::create(['nombre' => 'Modelo 4', 'num_puertas' => 1, 'peso_max' => 460, 'num_personas' => 4,
        'llave' => true, 'tipoaccionamiento' => TiposAccionamientos::ELECTRICO, 'manual' => 'manual_1.pdf']));
        array_push($modelos, \App\Models\Modelo::create(['nombre' => 'Modelo 5', 'num_puertas' => 2, 'peso_max' => 1400, 'num_personas' => 12,
        'llave' => true, 'tipoaccionamiento' => TiposAccionamientos::ELECTRICO, 'manual' => 'manual_1.pdf']));
        $this->command->comment("Modelos creados con éxito");

        // -------------------------------------------------------------------------------------
        // ASCENSORES (basados en modelos) (generar muchísimos ascensores instalados en diferentes calles) (desde fechas antiguas a más recientes)
        $this->command->line("Creando Ascensores");
        $ascensores_modelos = [];
        foreach($modelos as $modelo) {
            $modelo->save();
            array_push($ascensores_modelos, \App\Models\Ascensor::factory(random_int(1, 8))->create(['modelo_id' => $modelo->id]));
        }
        $this->command->comment("Ascensores creados con éxito");

        // -------------------------------------------------------------------------------------
        // TAREAS PASADAS (basadas en ascensores, asignadas por un operador a un tecnico) (generar muchas)
        $this->command->line("Creando Tareas (+clientes +partes) pasadas");
        foreach($ascensores_modelos as $ascensores) {
            foreach($ascensores as $ascensor) {
                $fecha_inst = $ascensor->fecha_instalacion->getTimestamp();
                // Se generan fechas de creación del parte desde que se instaló el ascensor hasta 14 días antes de hoy
                $fecha_inicio_tarea = new DateTime();
                $fecha_inicio_tarea->setTimestamp(rand($fecha_inst, time() - (14 * 24 * 60 * 60)));

            }
        }
        // PARTES REALIZADOS (basados en las tareas, realizados por un técnico) (generar muchos) (todos con fecha pasada)




        // -------------------------------------------------------------------------------------
        // TAREAS PENDIENTES (basadas en ascensores, asignadas por un operador a un tecnico) (generar máximo 1 o 2 por cada ascensor)
        $this->command->line("Creando Tareas (+clientes +partes) pendientes");




    }
}
