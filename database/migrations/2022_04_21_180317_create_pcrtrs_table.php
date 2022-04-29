<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcrtrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcrtrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('limpieza')->nullable()->default(false);
            $table->date('fecha');
            $table->time('hora');
            $table->boolean('biomek_400')->nullable();
            // $table->string('equipo'); //puede ser un catalogo, por lo que puede ser una llave foranea
            $table->string('curva_estandar');
            $table->string('lote_kit_power_quant');
            $table->date('fecha_elaboracion');
            $table->string('r2');
            $table->string('eficiencia');

            //foreign_key
            #equipo_id
            $table->bigInteger('equipo_id')->unsigned()->nullable();
            $table->foreign('equipo_id')->references('id')->on('equipos');
            #user_id
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('pcrtrs');
    }
}
