<?php

namespace Database\Seeders;

use App\Models\Enums\EstadosTareas;
use App\Models\Enums\EstadosTareas as EnumsEstadosTareas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use DateTime;

// Enums
use App\Models\Enums\Roles;
use App\Models\Enums\TiposAccionamientos;
use App\Models\Enums\TiposTareas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // VARIABLES QUE VARIARÁN EL NÚMERO DE DATOS A GENERAR
        $v_num_jefes_equipos = 5; // mínimo 1, default 5
        $v_num_min_tecnicos_equipo = 2; // mínimo 1, default 1
        $v_num_max_tecnicos_equipo = 7; // default 5
        $v_num_min_operadores = 5; // mínimo 1, default 4
        $v_num_max_operadores = 10; // default 8
        $v_num_min_ascensores_modelo = 10; // default 1
        $v_num_max_ascensores_modelo = 45; // default 8
        $v_num_min_tareas = 0; // POR ASCENSOR, default 0
        $v_num_max_tareas = 15; // POR ASCENSOR, default 15
        $v_num_min_tareas_pendientes = 25; // default 15
        $v_num_max_tareas_pendientes = 30; // default 30

        // COMIENZO DEL SEEDING
        $this->command->info("Starting Seeding. ");
        // -------------------------------------------------------------------------------------
        // DATOS FIJOS
        // -------------------------------------------------------------------------------------
        $this->command->line("Creando datos fijos (administradores)");
        // Administradores
        $dani = \App\Models\User::create([
            'nombre' => 'Daniel',
            'apellidos' => 'Tamargo Saiz',
            'email' => 'daniel.tamargo@igobide.com',
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

        $alaitz = \App\Models\User::create([
            'nombre' => 'Alaitz',
            'apellidos' => 'Candela Murelaga',
            'email' => 'alaitz.candela@igobide.com',
            'email_verified_at' => now(),
            'telefono' => '693248546',
            'rol' => Roles::ADMINISTRADOR, // administrador, tecnico, operador, jefeequipo
            'dni' => '81939760Y',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'abcdefghij',
        ]);
        $alaitz->save();

        $alaitz = \App\Models\Administrador::create([
            'codigo' => "adm_" . str_pad($alaitz->id, 5, "0", STR_PAD_LEFT),
            'user_id' => $alaitz->id
        ]);
        $alaitz->save();

        $txaber = \App\Models\User::create([
            'nombre' => 'Txaber',
            'apellidos' => 'Gardeazabal Larrory',
            'email' => 'txaber.gardeazabal@igobide.com',
            'email_verified_at' => now(),
            'telefono' => '678436952',
            'rol' => Roles::ADMINISTRADOR, // administrador, tecnico, operador, jefeequipo
            'dni' => '36512592T',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'abcdefghij',
        ]);
        $txaber->save();

        $txaber = \App\Models\Administrador::create([
            'codigo' => "adm_" . str_pad($txaber->id, 5, "0", STR_PAD_LEFT),
            'user_id' => $txaber->id
        ]);
        $txaber->save();

        $this->command->comment("Datos fijos (administradores) creados correctamente");

        // -------------------------------------------------------------------------------------
        // DATOS FAKE ALEATORIOS
        // -------------------------------------------------------------------------------------
        // EQUIPOS (JEFE + TÉCNICOS)
        $this->command->line("Creando Equipos (Jefes de Equipo + Técnicos)");
        $tecnicos = [];
        for ($i = 0; $i < $v_num_jefes_equipos; $i++) { // 5 Jefes de Equipo
            // Usuario jefe de equipo
            $jefeequipo = \App\Models\User::factory(1)->create(['rol' => Roles::JEFEEQUIPO])[0];
            // Entidad empleo JefeEquipo
            $jefeequipo = \App\Models\JefeEquipo::create([
                'codigo' => "jef_" .str_pad($jefeequipo->id, 5, "0", STR_PAD_LEFT),
                'user_id' => $jefeequipo->id
            ]);
            $jefeequipo->save();

            // Número de técnicos que tendrá asignado cada jefe
            $numTecnicos = rand($v_num_min_tecnicos_equipo, $v_num_max_tecnicos_equipo);
            // Usuarios técnicos asignados al jefe
            $tecnicos_equipo = \App\Models\User::factory($numTecnicos)->create(['rol' => Roles::TECNICO]);
            // Entidades empleo Tecnico de cada técnico creado
            foreach($tecnicos_equipo as $tecnico) {
                $datos = \App\Models\Tecnico::create([
                    'codigo' => "tec_" .str_pad($tecnico->id, 5, "0", STR_PAD_LEFT),
                    'user_id' => $tecnico->id,
                    'jefe_codigo' => $jefeequipo->codigo,
                ]);
                $datos->save();
                $tecnico["codigo"] = $datos->codigo;
            }

            array_push($tecnicos, $tecnicos_equipo);
        }
        $this->command->comment("Equipos creados con éxito");
        // -------------------------------------------------------------------------------------
        // OPERADORES
        $this->command->line("Creando Operadores");
        // Número de operadores
        $numOperadores = rand($v_num_min_operadores, $v_num_max_operadores);
        // Usuarios operadores
        $operadores = \App\Models\User::factory($numOperadores)->create(['rol' => Roles::OPERADOR]);
        // Entidades empleo Operador de cada operador creado
        foreach($operadores as $operador) {
            $datos = \App\Models\Operador::create([
                'codigo' => "op_" .str_pad($operador->id, 5, "0", STR_PAD_LEFT),
                'user_id' => $operador->id,
            ]);
            $datos->save();
            $operador["codigo"] = $datos->codigo;
        }
        $this->command->comment("Operadores creados con éxito");
        // -------------------------------------------------------------------------------------
        // MODELOS
        $this->command->line("Creando Modelos");
        $modelos = [];
        array_push($modelos, \App\Models\Modelo::create(['nombre' => 'ELEV2DS', 'num_puertas' => 1, 'peso_max' => 460, 'num_personas' => 4,
        'llave' => false, 'tipoaccionamiento' => TiposAccionamientos::HIDRAULICO, 'manual' => 'ELEV2DS.pdf']));
        array_push($modelos,\App\Models\Modelo::create(['nombre' => 'ASCOP2DZ', 'num_puertas' => 1, 'peso_max' => 340, 'num_personas' => 3,
        'llave' => false, 'tipoaccionamiento' => TiposAccionamientos::HIDRAULICO, 'manual' => 'ASCOP2DZ.pdf']));
        array_push($modelos, \App\Models\Modelo::create(['nombre' => 'LBST2DP', 'num_puertas' => 2, 'peso_max' => 420, 'num_personas' => 4,
        'llave' => false, 'tipoaccionamiento' => TiposAccionamientos::HIDRAULICO, 'manual' => 'LBST2DP.pdf']));
        array_push($modelos, \App\Models\Modelo::create(['nombre' => 'ATD2500', 'num_puertas' => 1, 'peso_max' => 460, 'num_personas' => 4,
        'llave' => true, 'tipoaccionamiento' => TiposAccionamientos::ELECTRICO, 'manual' => 'ATD2500.pdf']));
        array_push($modelos, \App\Models\Modelo::create(['nombre' => 'CGT1240', 'num_puertas' => 2, 'peso_max' => 1400, 'num_personas' => 12,
        'llave' => true, 'tipoaccionamiento' => TiposAccionamientos::ELECTRICO, 'manual' => 'CGT1240.pdf']));
        $this->command->comment("Modelos creados con éxito");

        // -------------------------------------------------------------------------------------
        // ASCENSORES (basados en modelos) (generar muchísimos ascensores instalados en diferentes calles) (desde fechas antiguas a más recientes)
        $this->command->line("Creando Ascensores");
        $ascensores_modelos = [];
        foreach($modelos as $modelo) {
            $modelo->save();
            array_push($ascensores_modelos, \App\Models\Ascensor::factory(
                    rand($v_num_min_ascensores_modelo, $v_num_max_ascensores_modelo)
                )->create(['modelo_id' => $modelo->id]));
        }
        $this->command->comment("Ascensores creados con éxito");

        // -------------------------------------------------------------------------------------
        // TAREAS PASADAS (basadas en ascensores, asignadas por un operador a un tecnico) (generar muchas)
        $this->command->line("Creando Tareas (+clientes +partes) pasadas");
        foreach($ascensores_modelos as $ascensores) {
            foreach($ascensores as $ascensor) {
                // Obtenemos el timestamp de la fecha de instalación
                $timestamp_inst_asc = $ascensor->fecha_instalacion->getTimestamp();
                if ($timestamp_inst_asc >= time() - (14 * 24 * 60 * 60)) continue; // <- si el ascensor lleva menos de 14 días instalado, pasamos
                // Generamos un número aleatorio de tareas resueltas del ascensor
                $num_tareas = rand($v_num_min_tareas, $v_num_max_tareas);
                for($i = 0; $i < $num_tareas; $i++) {
                    // Se genera una fecha aleatoria de creación del parte desde que se instaló el ascensor hasta 14 días antes de hoy
                    $fecha_inicio_tarea = new DateTime();
                    $fecha_inicio_tarea->setTimestamp(rand($timestamp_inst_asc, time() - (14 * 24 * 60 * 60)));
                    // Seleccionamos técnico aleatorio
                    $tecnicos_equipo = $tecnicos[rand(0, count($tecnicos) - 1)];
                    $tecnico_codigo = $tecnicos_equipo[rand(0, count($tecnicos_equipo) - 1)]->codigo; //tecnico aleatorio
                    // Generamos unas tareas
                    $tareas_asc = \App\Models\Tarea::factory(1)
                                    ->create([
                                        'ascensor_ref' => $ascensor->num_ref,
                                        'operador_codigo' => $operadores[rand(0, count($operadores) - 1)]->codigo, //operador tecnico
                                        'tecnico_codigo' => $tecnico_codigo, //tecnico aleatorio
                                        'fecha_creacion' => $fecha_inicio_tarea
                                    ]);

                    // PARTES REALIZADOS (basados en las tareas, realizados por un técnico) (generar muchos) (todos con fecha pasada)
                    foreach($tareas_asc as $tarea) {
                        // Por cada tarea generamos partes
                        // Fecha del parte
                        $timestamp_creacion_tarea = $tarea->fecha_creacion->getTimestamp();
                        $fecha_parte = new DateTime();
                        $fecha_parte->setTimestamp(rand($timestamp_creacion_tarea, time()));
                        // 0-5 probabilidad de imposiblesolucionar
                        // 6-15 probabilidad de que no se solventase en la primera
                        // 16-100 se solventó a la primera
                        $finalizado = false;
                        while (!$finalizado) {
                            $random = rand(0, 100); // sacamos el número del 0 al 100 para las probabilidades
                            $estado = EstadosTareas::FINALIZADO;
                            if ($random >= 16) {
                                $finalizado = true;
                                $tarea->fecha_finalizacion = $fecha_parte;
                            } else if ($random >= 6) {
                                // Mitad mitad para retrasado y materialnecesario
                                if ($random  >= 10) {
                                    $estado = EnumsEstadosTareas::MATERIALNECESARIO;
                                } else {
                                    $estado = EnumsEstadosTareas::RETRASADO;
                                }
                                $timestamp_parte = $fecha_parte->getTimestamp();
                                $fecha_parte->setTimestamp(rand($timestamp_parte, time()));
                            } else {
                                $finalizado = true;
                                $estado = EnumsEstadosTareas::IMPOSIBLESOLUCIONAR;
                                $tarea->fecha_finalizacion = $fecha_parte;
                            }

                            // Guardamos el parte
                            \App\Models\Parte::create([
                                'tecnico_codigo' => $tarea->tecnico_codigo,
                                'tarea_tipo' => $tarea->tipo,
                                'tarea_id' => $tarea->id,
                                'fecha_parte' => $fecha_parte,
                                'tarea_estado' => $estado,
                                'anotacion' => 'Parte autogenerado',
                            ])->save();

                            // Actualizamos el estado de la tarea al estado que haya determinado el parte
                            $tarea->estado = $estado;
                            $tarea->save();

                            // Si era una revisión, actualizamos la fecha de la última revisión
                            if ($tarea->tipo == TiposTareas::REVISION) {
                                $asc = \App\Models\Ascensor::find($tarea->ascensor_ref);
                                $asc->fecha_ultima_revision = $fecha_parte;
                                $asc->save();
                                // Otra forma:
                                //\Illuminate\Support\Facades\DB::table('ascensores')->where('num_ref', $tarea->ascensor_ref)->update(['fecha_ultima_revision' => $fecha_parte]);
                            }
                        }
                    }
                }

            }
        }
        $this->command->comment("Tareas (+clientes +partes) pasadas creadas con éxito");

        // -------------------------------------------------------------------------------------
        // TAREAS PENDIENTES (basadas en ascensores, asignadas por un operador a un tecnico) (generar máximo 1 o 2 por cada ascensor)
        $this->command->line("Creando Tareas (+clientes) pendientes");

        // Generamos entre 10 y 20 tareas pendientes
        $num_tareas_pendientes = rand($v_num_min_tareas_pendientes, $v_num_max_tareas_pendientes);
        for($i = 0; $i < $num_tareas_pendientes; $i++) {
            // Datos referencias
            $ascensores_modelo = $ascensores_modelos[rand(0, count($ascensores_modelos) - 1)];
            $ascensor_ref = $ascensores_modelo[rand(0, count($ascensores_modelo) - 1)]->num_ref; //ascensor aleatorio
            $tecnicos_equipo = $tecnicos[rand(0, count($tecnicos) - 1)];
            $tecnico_codigo = $tecnicos_equipo[rand(0, count($tecnicos_equipo) - 1)]->codigo; //tecnico aleatorio
            $operador_codigo = $operadores[rand(0, count($operadores) - 1)]->codigo; //operador tecnico

            // Tareas pendientes:
            \App\Models\Tarea::factory(1)->create([
                'ascensor_ref' => $ascensor_ref,
                'operador_codigo' => $operador_codigo,
                'tecnico_codigo' => $tecnico_codigo,
                'fecha_creacion' => new DateTime()
            ]);
        }
        $this->command->comment("Tareas (+clientes) pendientes creadas con éxito");
    }
}
