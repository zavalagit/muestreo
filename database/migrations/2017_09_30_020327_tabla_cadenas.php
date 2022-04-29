<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaCadenas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadenas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_registro');
            $table->string('ci_pp');
            $table->string('amp');            
            $table->string('servicio');           
            $table->string('calle1');           
            $table->string('calle2');           
            $table->string('calle3');           
            $table->string('numero_exterior');        
            $table->string('numero_interior');     
            $table->string('referencias');     
            $table->enum('clima',['seco','nublado','lluvioso']);
            $table->enum('iluminacion',['natural','artificial','buena','regular','escasa','mala']);
            $table->enum('temperatura',['fria','tremplada','calor']);
            $table->enum('traslado',['abierto','cerrado','temperatura_fria','temperatura_ambiente']);
            $table->string('traslado_otros')->nullable();
            
            
            //key foranea unidades
            $table->bigInteger('municipio_id')->unsigned()->nullable();
            $table->foreign('municipio_id')
               ->references('id')->on('municipios');

            //key foranea unidades
            $table->bigInteger('unidad_id')->unsigned()->nullable();
            $table->foreign('unidad_id')
               ->references('id')->on('unidades');

               $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
               ->references('id')->on('users')
               ->onDelete('cascade');
               
            // $table->string('folio_bodega')/*->unique()*/->nullable(); //unique desde valitation
            // $table->string('folio')->nullable();
            // $table->longText('intervencion_lugar')->nullable();
            // $table->time('intervencion_hora')->nullable();
            // $table->enum('motivo',['localizacion','descubrimiento','aportacion'])->nullable();
            //1. identidad
//            $table->longText('descripcion');
//            $table->string('identificadores');
            //2. Documentación
            // $table->enum('escrito',['si','no'])->nullable();
            // $table->enum('fotografico',['si','no'])->nullable();
            // $table->enum('croquis',['si','no'])->nullable();
            // $table->enum('otro',['si','no'])->nullable();
            // $table->string('especifique')->nullable();
            //3. Recoleccion
//            $table->string('manual')->nullable();
//            $table->string('instrumental')->nullable();
            //4. Empaque/embalaje
                //Campo del anexo 4
                // $table->longText('embalaje')->nullable();
            
            //5. Servidores publicos

            //6. Traslado
            // $table->enum('traslado',['terrestre','aerea','maritima'])->nullable();
            // $table->enum('trasladoCondiciones',['si','no'])->nullable();
            // $table->string('trasladoRecomendaciones')->nullable();

            // $table->enum('estado',['revision','rechazada','espera','validada','bloqueada'])->default('revision')->nullable();

            // $table->longText('nota')->nullable();

            // $table->enum('editar',['si','no'])->default('si')->nullable();

            //Llave foranea de que perito hizo la cadena
            // $table->integer('user_id')->unsigned()->nullable();
            // $table->foreign('user_id')
            //    ->references('id')->on('users')
            //    ->onDelete('cascade');
            // //key foranea unidades
            // $table->integer('unidad_id')->unsigned()->nullable();
            // $table->foreign('unidad_id')
            //    ->references('id')->on('unidades');
            // //    ->onDelete('cascade');
            // //key foranea unidades
            // $table->integer('fiscalia_id')->unsigned()->nullable();
            // $table->foreign('fiscalia_id')
            //    ->references('id')->on('fiscalias');
            //    ->onDelete('cascade');   
/*
            $table->integer('entrada_id')->unsigned()->nullable();
            $table->foreign('entrada_id')
               ->references('id')->on('entradas')
               ->onDelete('cascade');
*/
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
        Schema::dropIfExists('temps');
    }
}
