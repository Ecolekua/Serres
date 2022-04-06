<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstructurasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estructuras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('User_id')->unsigned();
            $table->foreign('User_id')->references('id')->on('users');
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            
            $table->date('fechaInicio');
            $table->integer('activo');
            $table->date('fechaCierre')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estructuras');
    }
}
