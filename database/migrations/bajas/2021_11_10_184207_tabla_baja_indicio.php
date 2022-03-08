<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaBajaIndicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baja_indicio', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('baja_id')->unsigned();
            $table->foreign('baja_id')->references('id')->on('utpyme.bodega.bajas');

            $table->bigInteger('indicio_id')->unsigned();
            $table->foreign('indicio_id')->references('id')->on('utpyme.bodega.indicios');

            $table->longText('baja_descripcion')->nullable();
            $table->integer('baja_cantidad_indicios');
            $table->enum('baja_tipo',['parcial','completa']);

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
        Schema::dropIfExists('baja_indicio');
    }
}
