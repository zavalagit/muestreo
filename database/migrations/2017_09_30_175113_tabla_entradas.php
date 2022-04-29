<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaEntradas extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('entradas', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->time('hora')->nullable();
         $table->date('fecha')->nullable();
         $table->enum('tipo', ['indicio', 'evidencia'])->nullable();
         $table->string('observacion')->nullable();
         //persona que entraga cadena e indicios
         $table->bigInteger('user1_id')->unsigned()->nullable();
         $table->foreign('user1_id')
            ->references('id')->on('users');
         ////Responsable de bodega que recibe
         $table->bigInteger('user2_id')->unsigned()->nullable();
         $table->foreign('user2_id')
            ->references('id')->on('users');

         $table->bigInteger('cadena_id')->unsigned();
         $table->foreign('cadena_id')
            ->references('id')->on('cadenas');

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
      Schema::dropIfExists('entradas');
   }
}
