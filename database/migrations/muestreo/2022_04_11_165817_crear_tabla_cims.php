<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCims extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega.cims', function (Blueprint $table) {
            $table->bigIncrements('id');

            //usuario que registra cim
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('bodega.users');

            //indicios que realacionas el cim
            $table->bigInteger('indicio_id')->unsigned();
            $table->foreign('indicio_id')->references('id')->on('bodega.indicios');

            //cim numero consecutivo/año de registro
            $table->string('codigo');

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
        Schema::dropIfExists('bodega.cims');
    }
}
