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

            //año del registro
            $table->Integer('year');

            //ultimo cim numero consecutivo/año de registro
            $table->bigInteger('cim');

            //ultimo usuario que registra cim
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('bodega.users');

            //indicios ultimo indcio que realacionas el cim
            $table->bigInteger('indicio_id')->unsigned();
            $table->foreign('indicio_id')->references('id')->on('bodega.indicios');

            

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
