<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuestreosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muestreos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('limpieza')->nullable()->default(false);
            $table->date('fecha');
            $table->time('hora');
            $table->boolean('fotos_diagramas')->nullable()->default(false);
            $table->string('fragmento1')->nullable();
            $table->string('fragmento2')->nullable();
            $table->text('observacion_otro')->nullable();
            
            $table->string('supervision');

            $table->boolean('descalsificacion')->nullable();
            $table->integer('descalsificacion_dias')->nullable();

            $table->boolean('alcohol')->nullable();
            $table->enum('tecnica_utilizada',['laminado','otro']);
            $table->text('tecnica_utilizada_otro')->nullable();
            //user1_id (Perito que analiza, el que realiza el registro)
            $table->bigInteger('user1_id')->unsigned()->nullable();
            $table->foreign('user1_id')->references('id')->on('users');
            //user2_id (Perito que atestigua en caso de no contar con el campo "fotos_diagramas")
            $table->bigInteger('user2_id')->unsigned()->nullable();
            $table->foreign('user2_id')->references('id')->on('users');
            //proceso_id
            // $table->bigInteger('proceso_id')->unsigned()->nullable();
            // $table->foreign('proceso_id')->references('id')->on('procesos');
            
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
        Schema::dropIfExists('muestreos');
    }
}
