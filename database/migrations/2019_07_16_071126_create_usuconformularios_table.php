<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuconformulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuconformularios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('estructura_id')->unsigned();
            $table->foreign('estructura_id')->references('id')->on('estructuras');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('formulario');
            $table->integer('periodoInicio')->unsigned()->nullable();
            $table->integer('periodoFin')->unsigned()->nullable();
            $table->integer('activo')->unsigned();
            $table->string('pivote')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuconformularios');
    }
}
