<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaColectivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::create('bodega.colectivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('colectivo_grupo_familiar')->nullable();
            // $table->string('colectivo_cim')->nullable();
            $table->string('colectivo_donante')->nullable();
            $table->date('colectivo_fecha')->nullable();
            $table->enum('documento_emitido',['tarjeta_informativa'])->nullable();
            $table->date('colectivo_validacion_fecha')->nullable();
            $table->date('colectivo_emision_fecha')->nullable();
            $table->string('colectivo_emision_persona')->nullable();
            $table->enum('colectivo_estado',['revision','validada'])->default('revision');
            #llave fonaria entidad
            $table->bigInteger('entidad_id')->unsigned();
            $table->foreign('entidad_id')->references('id')->on('bodega.entidades');
            #llave fonaria delegacion
            $table->bigInteger('delegacion_id')->unsigned()->nullable();
            $table->foreign('delegacion_id')->references('id')->on('bodega.delegaciones');
            #llave fonaria users
            $table->bigInteger('user1_id')->unsigned();
            $table->foreign('user1_id')->references('id')->on('bodega.users');
            $table->bigInteger('user2_id')->unsigned()->nullable();
            $table->foreign('user2_id')->references('id')->on('bodega.users');
            #llave fonaria region
            $table->bigInteger('fiscalia_id')->unsigned();
            $table->foreign('fiscalia_id')->references('id')->on('bodega.fiscalias');
            
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
        Schema::dropIfExists('colectivos');
    }
}
