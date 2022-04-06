<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudcerradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudcerradas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('estructura_id')->unsigned();
            $table->foreign('estructura_id')->references('id')->on('estructuras');
           
            $table->integer('mes')->unsigned();
            $table->integer('ano')->unsigned();
            $table->integer('contratados')->unsigned();
            $table->integer('desvinculados')->unsigned();
            $table->integer('otrascausas')->unsigned();
            $table->integer('totalvigentes')->unsigned();
            $table->string('observaciones');
            $table->string('estado');
            $table->string('pivote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudcerradas');
    }
}
