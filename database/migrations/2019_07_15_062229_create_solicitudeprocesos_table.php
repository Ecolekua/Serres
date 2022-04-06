<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudeprocesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudeprocesos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('estructura_id')->unsigned();
            $table->foreign('estructura_id')->references('id')->on('estructuras');
            
            $table->integer('mes')->unsigned()->nullable();
            $table->integer('ano')->unsigned()->nullable();
            $table->integer('contratados')->unsigned()->nullable();
            $table->integer('desvinculados')->unsigned()->nullable();
            $table->integer('otrascausas')->unsigned()->nullable();
            $table->integer('totalvigentes')->unsigned()->nullable();
            $table->string('observaciones')->nullable();
            $table->string('estado');
            $table->string('pivote');
            $table->integer('inspector_id')->nullable();

            // campos del nuevo formulario
            $table->integer('rectcert')->nullable();
            $table->integer('contdocutrab')->nullable();
            $table->integer('contdocuempr')->nullable();
            $table->integer('evalfina')->nullable();
            $table->integer('otro')->nullable();
            $table->integer('numerocertificado')->nullable();
            $table->string('otroobser')->nullable();
            // fin campos del nuevo formulario

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudeprocesos');
    }
}
