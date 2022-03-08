<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaColectivoParentesco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colectivo_parentesco', function (Blueprint $table) {
            $table->bigIncrements('id');
            #colectivo_id
            $table->bigInteger('colectivo_id')->unsigned();
            $table->foreign('colectivo_id')->references('id')->on('bodega.colectivos');
            #parentesco_id
            $table->bigInteger('parentesco_id')->unsigned();
            $table->foreign('parentesco_id')->references('id')->on('bodega.parentescos');
            #columnas pivote ()
            $table->string('ausente_nombre')->nullable();
            $table->enum('ausente_sexo',['masculino','femenino'])->nullable();
            $table->date('ausente_fecha_nacimiento')->nullable();
            $table->integer('ausente_edad')->nullable();
            $table->string('ausente_lugar_desaparicion')->nullable();
            $table->date('ausente_fecha_desaparicion')->nullable();
            $table->string('parentesco_otro')->nullable();
            $table->longText('ausente_objeto_aportado')->nullable();
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
        Schema::dropIfExists('colectivo_parentesco');
    }
}
