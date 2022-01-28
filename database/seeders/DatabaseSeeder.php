<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'rol' => 'administrador', //TODO pasarlo a enumeración
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
            $jefeequipo = \App\Models\User::factory(1)->create(['rol' => 'jefeequipo'])[0];
            // Entidad empleo JefeEquipo
            $jefeequipo = \App\Models\JefeEquipo::create([
                'codigo' => "jef_" .str_pad($jefeequipo->id, 5, "0", STR_PAD_LEFT),
                'user_id' => $jefeequipo->id
            ]);

            // Número de técnicos que tendrá asignado cada jefe
            $numTecnicos = random_int(1, 5);
            // Usuarios técnicos asignados al jefe
            $tecnicos = \App\Models\User::factory($numTecnicos)->create(['rol' => 'tecnico']);
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
        $operadores = \App\Models\User::factory($numOperadores)->create(['rol' => 'operador']);
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


        // -------------------------------------------------------------------------------------
        // ASCENSORES (basados en modelos) (generar muchísimos ascensores instalados en diferentes calles) (desde fechas antiguas a más recientes)



        // -------------------------------------------------------------------------------------
        // TAREAS PASADAS (basadas en ascensores, asignadas por un operador a un tecnico) (generar muchas)



        // TAREAS PENDIENTES (basadas en ascensores, asignadas por un operador a un tecnico) (generar máximo 1 o 2 por cada ascensor)

        // -------------------------------------------------------------------------------------
        // PARTES REALIZADOS (basados en las tareas, realizados por un técnico) (generar muchos) (todos con fecha pasada)


        //

    }
}
