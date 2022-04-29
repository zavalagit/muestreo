<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio')->unique();
            $table->string('name');
            $table->string('password')->nullable();
            $table->enum('tipo', ['usuario', 'responsable_bodega', 'administrador']);
            $table->boolean('esta_actvio')->default(true);

            $table->bigInteger('unidad_id')->unsigned();
            $table->foreign('unidad_id')
                ->references('id')->on('unidades')
                ->onDelete('cascade');
            //cargo
            $table->bigInteger('cargo_id')->unsigned();
            $table->foreign('cargo_id')
                ->references('id')->on('cargos')
                ->onDelete('cascade');
            
            $table->bigInteger('institucion_id')->unsigned();
            $table->foreign('institucion_id')
                ->references('id')->on('instituciones')
                ->onDelete('cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
