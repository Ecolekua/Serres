<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaempleadosCertificados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleadoscertificados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('rut',10)->nullable();
            $table->string('nombre',200)->nullable();
            $table->integer('certificado_id')->unsigned();
            $table->foreign('certificado_id')->references('id')->on('certificados');
            $table->integer('Empleado_id')->unsigned()->nullable();
            $table->foreign('Empleado_id')->references('id')->on('Empleados');
            $table->string('cargo',100)->nullable();
            $table->string('fechaRetiro')->nullable();
            $table->string('pivote');
            $table->string('comparacion')->nullable();
            $table->string('estado');
            $table->integer('totalHaberes')->nullable();
            $table->integer('totalImponibles')->nullable();
            $table->integer('liquidoPago')->nullable();
            $table->integer('contingenciaPrevisional')->nullable();
            $table->integer('contingenciaRemuneracional')->nullable();
            $table->integer('contingenciaContrato')->nullable();
            $table->integer('contingenciaFiniquito')->nullable();
            $table->string('ceCos')->nullable();
            $table->integer('hojaNomina')->nullable();
            $table->string('nacionalidad',50)->nullable();
            $table->string('genero',50)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleadosCertificados');
    }
}
