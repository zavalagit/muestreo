<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('limpieza')->nullable()->default(false);
            $table->date('fecha');
            $table->time('hora');
            #solicion
            $table->string('solucion_metodo')->nullable();
            $table->string('lote_buffer_lisis1');
            $table->string('lote_buffer_lisis2');
            $table->string('lote_buffer_elucion1');
            $table->string('lote_buffer_elucion2');
            $table->boolean('custom');
            $table->integer('custom_buffer_desmineralizacion')->nullable();
            $table->integer('custom_proteinasa_k')->nullable();
            $table->integer('custom_thiglycerol')->nullable();            
            $table->boolean('bone');
            $table->integer('bone_buffer_lisis')->nullable();
            $table->integer('bone_proteinasa_k')->nullable();
            $table->integer('bone_dtt')->nullable();
            #termomixer
            $table->string('termomixer')->nullable();
            $table->string('termomixer_otro')->nullable();
            #temperatura
            $table->integer('temperatura')->nullable();
            $table->integer('temperatura_otro')->nullable();
            #rpm
            $table->integer('rpm')->nullable();
            $table->integer('rpm_otro')->nullable();
            #tiempo
            $table->integer('tiempo')->nullable();
            $table->integer('tiempo_otro')->nullable();

            $table->date('fecha_purificacion');
            $table->time('hora_purificacion');

            $table->string('lote_kit');
            
            $table->string('purificacion_observaciones')->nullable();

            $table->string('supervición');

            //purificador_id
            // $table->bigInteger('purificador_id')->unsigned()->nullable();
            // $table->foreign('purificador')->references('id')->on('purificadores');

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
        Schema::dropIfExists('extracciones');
    }
}
