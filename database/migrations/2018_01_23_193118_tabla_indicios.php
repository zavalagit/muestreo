<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaIndicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identificador');
            $table->longText('descripcion');
            $table->string('embalaje');
            $table->longText('observaciones')->nullable();
            $table->integer('cantidad')->nullable();
            $table->integer('cantidad_disponible')->nullable();
            $table->enum('estado',['activo','prestamo','baja','activo_prestamo','activo_baja','prestamo_baja'])->default('activo');
            // $table->boolean('es_arma')->nullable();
            $table->bigInteger('cadena_id')->unsigned()->nullable();
            $table->foreign('cadena_id')
               ->references('id')->on('cadenas');


            //Lugar de resguardo del indicio que no sea un lugar, charola o caja
            // $table->longText('resguardo')->nullable();


            
            
            // $table->integer('ubicacion_id')->unsigned()->nullable();
            // $table->foreign('ubicacion_id')
            //    ->references('id')->on('ubicaciones');

            // $table->integer('baja_id')->unsigned()->nullable();
            // $table->foreign('baja_id')
            //    ->references('id')->on('bajas');

/*
            $table->string('cedula_folio')->nullable();
            $table->foreign('cedula_folio')
               ->references('folio')->on('cedulas');
*/
/*

            $table->integer('lugar_id')->unsigned()->nullable();
            $table->foreign('lugar_id')
               ->references('id')->on('lugares');
/*
            $table->integer('charola_id')->unsigned()->nullable();
            $table->foreign('charola_id')
               ->references('id')->on('charolas');

            $table->integer('caja_id')->unsigned()->nullable();
            $table->foreign('caja_id')
               ->references('id')->on('cajas');
*/
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
        Schema::dropIfExists('descripciones');
    }
}
