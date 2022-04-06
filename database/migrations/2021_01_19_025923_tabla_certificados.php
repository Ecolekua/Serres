<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaCertificados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('estructura_id')->unsigned();
            $table->foreign('estructura_id')->references('id')->on('estructuras');
            $table->string('mes')->nullable();
            $table->integer('nmes');
            $table->integer('anio');
            $table->string('obs1',200);
            $table->string('obs2',200);
            $table->string('obs3',200);
            $table->string('obs4',200);
            $table->integer('montoRemuneracional')->nullable();
            $table->integer('montoPrevisional')->nullable();
            $table->integer('empleadosMesAnterior')->nullable();
            $table->date('fechaEmision')->nullable();
            $table->date('fechaInicioInspeccion')->nullable();
            $table->date('fechaFinInspeccion')->nullable();
            $table->date('fechaPagoCotizaciones')->nullable();
            $table->string('segundaNomina',1)->nullable();
            $table->string('contratoVisible',1)->nullable();
            $table->string('nominaExtendida',1)->nullable();
            $table->string('reemplazaA',1)->nullable();
            $table->string('vistoContrato',2)->nullable();
            $table->string('vistoFiniquito',2)->nullable();
            $table->string('vistoSueldo',2)->nullable();
            $table->string('vistoPrevision',2)->nullable();
            $table->integer('empleadoNuevos')->nullable();
            $table->integer('retirosFiniquitos')->nullable();
            $table->integer('totalRevizados');
            $table->integer('dotacionFinal');
            $table->integer('responsableInspeccion_id')->unsigned();
            $table->foreign('responsableInspeccion_id')->references('id')->on('users');
            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudeprocesos');
            $table->string('estado',30)->nullable();
            $table->integer('firma_id')->unsigned()->nullable();
            $table->foreign('firma_id')->references('id')->on('users')->nullable();
            $table->string('pivote',100);
            $table->integer('tipo')->nullable();
            $table->string('abreviacion')->nullable();
            $table->string('observaciónRechazo')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificados');
    }
}
