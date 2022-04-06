<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->string('proyecto');
            $table->string('direccion',200);
            $table->string('contacto',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('comuna',200)->nullable();
            $table->string('telefono',20)->nullable();
            $table->date('fechaInicio')->nullable();
            $table->date('fechaTermino')->nullable();
            $table->integer('activo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
