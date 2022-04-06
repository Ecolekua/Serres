<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('rut',10)->unique();
            $table->string('nombre',200);
            $table->string('direccion',200);
            $table->string('comuna',150);
            $table->string('email',150);
            $table->string('telefonos',50);
            $table->string('giro',150)->nullable();
            $table->string('rutRepLeg',10)->nullable();
            $table->string('nomRepLeg',200)->nullable();
            $table->string('tipoEmpresa',50);
            $table->string('nomContacto',200);
            $table->string('fonContacto',50);
            $table->string('emailContacto',200);
            $table->string('mutualidad',50)->nullable();
            $table->string('especialidad',150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
