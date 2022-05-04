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

            //proceso al que esta relacionado
            $table->bigInteger('proceso_id')->unsigned()->nullable();
            $table->foreign('proceso_id')->references('id')->on('bodega.procesos');

            //Responsable del perito que registra
            $table->bigInteger('perito_id')->unsigned();
            $table->foreign('perito_id')->references('id')->on('bodega.users');

            //Responsable del quimico que supervisa
            $table->bigInteger('supervisor_id')->unsigned();
            $table->foreign('supervisor_id')->references('id')->on('bodega.users');

                                    
            //nombre de la bitacora
            $table->string('bitacora')->nullable();
            
            //numero de libro
            $table->bigInteger('numero_libro')->nullable();

            //folio interno
            $table->string('folio_interno')->nullable();
            
            //hora de inicio del registro
            $table->time('hora_inicio')->nullable();

            //fecha del gegistro
            $table->date('fecha_inicio')->nullable();

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
        Schema::dropIfExists('bodega.codificaciones');
    }
}
