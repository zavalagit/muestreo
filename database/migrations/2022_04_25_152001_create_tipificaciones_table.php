<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipificaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('limpieza')->nullable()->default(false);
            $table->date('fecha');
            $table->time('hora');

            $table->integer('numero_amplificacion');
            $table->integer('numero_placa');
            // $table->integer('reactivo');
            $table->integer('reactivo_hidi_numero_lote');
            $table->integer('reactivo_ladder_numero_lote');
            $table->enum('reactivo_ils',['ils_500','ils_500_y23']);
            $table->integer('reactivo_ils_numero_lote');
            $table->integer('reactivo_pop4_polimero_numero_lote');
            $table->integer('reactivo_abc_numero_lote');
            $table->integer('reactivo_cbc_numero_lote');
            $table->integer('reactivo_arreglo_capilar_numero_lote');
            $table->enum('metodo_programado',['48','na']);
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
        Schema::dropIfExists('tipificaciones');
    }
}
