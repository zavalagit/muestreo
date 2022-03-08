<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaColectivoPrueba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colectivo_prueba', function (Blueprint $table) {
            $table->bigIncrements('id');
            #colectivo_id
            $table->bigInteger('colectivo_id')->unsigned();
            $table->foreign('colectivo_id')->references('id')->on('bodega.colectivos');
            #prueba_id
            $table->bigInteger('prueba_id')->unsigned();
            $table->foreign('prueba_id')->references('id')->on('bodega.pruebas');
            #columnas pivote
            #otra prueba
            $table->string('prueba_otro')->nullable();
            #cim
            $table->string('prueba_cim')->nullable();
            #cantidad_estudios
            $table->bigInteger('prueba_estudios')->default(0);
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
        Schema::dropIfExists('colectivo_prueba');
    }
}
