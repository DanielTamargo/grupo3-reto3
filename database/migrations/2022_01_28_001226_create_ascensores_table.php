<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAscensoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ascensores', function (Blueprint $table) {
            $table->string('num_ref', 10)->primary();
            $table->string('ubicacion');
            $table->unsignedBigInteger('modelo_id');
            $table->integer('num_plantas');
            $table->timestamp('fecha_instalacion')->useCurrent(); // <- useCurrent = Set TIMESTAMP columns to use CURRENT_TIMESTAMP as default value.
            $table->timestamp('fecha_ultima_revision')->useCurrent(); // fuente: https://laravel.com/docs/8.x/migrations#column-modifiers
            $table->timestamps();

            // Relación con el modelo
            $table->foreign('modelo_id')
                ->references('id')
                ->on('modelos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ascensores');
    }
}
