<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRelacionUnidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_unidad', function (Blueprint $table) {
            $table->bigIncrements('id');
            //unidad padre
            $table->bigInteger('unidad1_id')->unsigned();
            $table->foreign('unidad1_id')->references('id')->on('bodega.unidades');
            
            //unidad hijo
            $table->bigInteger('unidad2_id')->unsigned();
            $table->foreign('unidad2_id')->references('id')->on('bodega.unidades');
            
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
        Schema::dropIfExists('relacion_unidad');
    }
}
