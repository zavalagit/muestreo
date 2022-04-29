<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('limpieza')->nullable()->default(false);
            $table->date('fecha');
            $table->time('hora');
            $table->boolean('biomek_400')->nullable();
            $table->boolean('r_lg_r007')->default(false);
            $table->boolean('r_lg_r009')->default(false);
            $table->integer('numero_libro');
            $table->integer('numero_hoja');
            $table->integer('numero_amplificacion');
            $table->integer('numero_lote');
            $table->string('observaciones')->nullable();


            //foreign_key
            #kit_id
            $table->bigInteger('kit_id')->unsigned()->nullable();
            $table->foreign('kit_id')->references('id')->on('kits');
            #termociclador_id
            $table->bigInteger('termociclador_id')->unsigned()->nullable();
            $table->foreign('termociclador_id')->references('id')->on('termocicladores');
            #user_id
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            #user1_id (supervisor)
            $table->bigInteger('user1_id')->unsigned()->nullable();
            $table->foreign('user1_id')->references('id')->on('users');
            #proceso_id
            $table->bigInteger('proceso_id')->unsigned()->nullable();
            $table->foreign('proceso_id')->references('id')->on('procesos');

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
        Schema::dropIfExists('pcrs');
    }
}
