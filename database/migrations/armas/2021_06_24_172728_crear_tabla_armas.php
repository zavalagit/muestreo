<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaArmas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega.armas', function (Blueprint $table) {
            $table->bigIncrements('id');
            //clasificacion (corta,larga)
            $table->enum('clasificacion',['corta','larga'])->nullable();
            //agrupacion
            $table->enum('agropación',['fuego','hechiza','artesanal','deportiva','replica'])->nullable();
            //tipo de arma (ej.: fifle,escopeta,revolver,...)
            $table->string('tipo')->nullable();
            //fabricante  (marca)
            $table->string('fabricante')->nullable();
            //serie
            $table->string('serie')->nullable(); 
            //modelo
            $table->string('modelo')->nullable();
            //calibre
            $table->string('calibre')->nullable();           
            //importador (empresa)
            $table->string('importador')->nullable();
            //domicilio
            $table->string('domicilio')->nullable();
            //pais de origin
            $table->bigInteger('pais_id')->unsigned()->nullable();
            $table->foreign('pais_id')->references('id')->on('paises');
            //calibre_id
            // $table->bigInteger('bodega.caibre_id')->unsigned()->nullable();
            // $table->foreign('caibre_id')->references('id')->on('caibres');
            //indicio_id
            $table->bigInteger('indicio_id')->unsigned()->nullable();
            $table->foreign('indicio_id')->references('id')->on('bodega.indicios');
            //observacion
            $table->longText('observacion')->nullable();   

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
        Schema::dropIfExists('armas');
    }
}
