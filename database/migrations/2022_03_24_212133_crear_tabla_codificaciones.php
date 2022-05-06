<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCodificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega.codificaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            //nombre de la bitacora
            $table->string('bitacora')->nullable();
            $table->bigInteger('numero_libro')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->longText('observaciones')->nullable();
            #user1_id - usuario que realiza el proceso
            $table->bigInteger('user1_id')->unsigned();
            $table->foreign('user1_id')->references('id')->on('users');
            #user2_id - usuario que supervisa
            $table->bigInteger('user2_id')->unsigned();
            $table->foreign('user2_id')->references('id')->on('users');

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
        Schema::dropIfExists('bodega.codificaciones');
    }
}
