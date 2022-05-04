<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProcesos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega.procesos', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            //relacion de expediente
            $table->bigInteger('expediente_id')->unsigned()->nullable();
            $table->foreign('expediente_id')->references('id')->on('bodega.expedientes');

            $table->string('folio_proceso');

            $table->string('nombre');

            //hora de creación
            $table->time('hora_creacion')->nullable();

            //fecha de creación
            $table->date('fecha_creacion')->nullable();

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
        Schema::dropIfExists('bodega.procesos');
    }
}
