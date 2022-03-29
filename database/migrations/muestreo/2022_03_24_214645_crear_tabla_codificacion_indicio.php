<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCodificacionIndicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codificacion_indicio', function (Blueprint $table) {
            $table->bigIncrements('id');

            //codigo o cim de laboratorio
            $table->string('codigo')->nullable();

            #codificacion _id
            $table->bigInteger('codificacion_id')->unsigned();
            $table->foreign('codificacion_id')->references('id')->on('bodega.codificaciones');

            //indicio_id
            $table->bigInteger('indicio_id')->unsigned();
            $table->foreign('indicio_id')->references('id')->on('bodega.indicios');

            //descripcion del indicio
            $table->longText('descripcion')->nullable();
            
            //observacion
            $table->longText('observaciones')->nullable();

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
        Schema::dropIfExists('codificacion_indicio');
    }
}
