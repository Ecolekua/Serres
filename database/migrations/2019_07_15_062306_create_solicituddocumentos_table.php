<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicituddocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituddocumentos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('documento');
            $table->integer('orden')->unsigned();
            $table->string('estado');
            $table->string('tipodocumento');
            $table->string('observaciones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicituddocumentos');
    }
}
