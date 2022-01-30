<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partes', function (Blueprint $table) {
            // Datos base
            $table->id();
            $table->timestamps();
            $table->string('anotacion')->nullable(true);
            $table->timestamp('fecha_parte');
            // Datos relaciones
            $table->unsignedBigInteger('tarea_id');
            $table->string('tecnico_codigo');
            // Datos que rellena el técnico y que actualizarán la información de la tarea, pero también quedarán registrados en el parte
            $table->string('tarea_estado');
            $table->string('tarea_tipo');

            // Relaciones
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
            $table->foreign('tecnico_codigo')->references('codigo')->on('tecnicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partes');
    }
}
