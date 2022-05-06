<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicioProcesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicio_proceso', function (Blueprint $table) {
            $table->bigIncrements('id');
            #proceso_id
            $table->bigInteger('proceso_id')->unsigned()->nullable();
            $table->foreign('proceso_id')->references('id')->on('procesos');
            #indicio_id
            $table->bigInteger('indicio_id')->unsigned()->nullable();
            $table->foreign('indicio_id')->references('id')->on('indicios');
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
        Schema::dropIfExists('indicio_proceso');
    }
}
