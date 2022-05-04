<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaExpedientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega.expedientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nuc');

            $table->string('folio_expediente');

            //hora de creación
            $table->time('hora_creacion')->nullable();

            //fecha de creación
            $table->date('fecha_creacion')->nullable();

            //fecha de inicio
            $table->date('fecha_inicio')->nullable();

            //fecha de fin
            $table->date('fecha_final')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bodega.expedientes');
    }
}
