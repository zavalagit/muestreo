<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaObjetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega.objetos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nombre');

            $table->bigInteger('colectivo_id')->unsigned();
            $table->foreign('colectivo_id')->references('id')->on('bodega.colectivos');
            
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
        Schema::dropIfExists('objetos');
    }
}
