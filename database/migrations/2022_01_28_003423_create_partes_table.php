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
            $table->string('estado_resultado')->default('sintratar'); // TODO dani: enum
            $table->string('anotacion')->nullable(true);
            $table->string('tipo_tarea')->default('averia'); // TODO dani: que determine si estaba bien indicado el tipo
            // Datos relaciones
            $table->unsignedBigInteger('tarea_id');
            $table->string('tecnico_codigo');

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
