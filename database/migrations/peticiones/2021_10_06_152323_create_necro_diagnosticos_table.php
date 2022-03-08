<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNecroDiagnosticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('necro_diagnosticos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            //llave foranea necropsia_clasificacion
            $table->bigInteger('necro_calsificacion_id')->unsigned();
            $table->foreign('necro_calsificacion_id')->references('id')->on('necropsia_clasificaciones');

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
        Schema::dropIfExists('necro_diagnosticos');
    }
}
