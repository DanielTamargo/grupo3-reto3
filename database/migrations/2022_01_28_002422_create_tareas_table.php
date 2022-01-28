<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            // Datos base
            $table->id();
            $table->date('fecha_creacion');
            $table->date('fecha_finalizacion')->default(null);
            $table->string('descripcion');
            $table->string('tipo')->default('Avería');
            $table->string('estado')->default('sintratar'); // TODO dani: enum
            $table->integer('prioridad')->default(0); // 0 = baja, 5 = urgencia (por ejemplo (?))
            $table->timestamps();
            // Datos relaciones
            $table->string('ascensor_ref', 10);
            $table->unsignedBigInteger('cliente_id');
            $table->string('operador_codigo');
            $table->string('tecnico_codigo');

            // Relaciones
            $table->foreign('ascensor_ref')->references('num_ref')->on('ascensores')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('operador_codigo')->references('codigo')->on('operadores')->onDelete('cascade');
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
        Schema::dropIfExists('tareas');
    }
}
