<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('rut',10)->unique();
            $table->string('nombre',60);
            $table->string('apellidos',60);
            $table->string('direccion',150)->nullable();
            $table->string('mail',200)->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('comuna',100)->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->string('estadoCivil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Empleados');
    }
}
