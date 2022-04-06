<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPlanillaCertificado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planillacertificados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('HOLDING_ASOCIADO',50)->nullable();
            $table->string('CERTIFICADO',20);
            $table->string('RUT_CONTRATISTA',10);
            $table->string('RAZON_SOCIAL_CONTRATISTA',250);
            $table->string('RUT_MANDANTE',10);
            $table->string('RAZON_SOCIAL_MANDANTE',250);
            $table->string('RUT_TRABAJADOR',10);
            $table->string('NOMBRE_TRABAJADOR',200);
            $table->string('PERIODO_MES',10);
            $table->integer('PERIODO_ANIO');
            $table->string('ESTADO',25)->nullable();
            $table->string('ESTADO_TRABAJADOR',20);
            $table->integer('LIQUIDO_A_PAGO')->nullable();
            $table->integer('TOTAL_HABERES')->nullable();
            $table->integer('TOTAL_IMPONIBLE')->nullable();
            $table->string('OBSERVACION_PLANILLA',20);
            $table->integer('OBSERVACION_REMUNERACIONAL')->nullable();
            $table->integer('OBSERVACION_PREVISIONAL')->nullable();
            $table->string('CONTRATO_CONTRATISTA',100);
            $table->string('PROYECTO_CONTRATISTA',200);
            $table->string('RUT_CONTRATISTA_X_SUBCONTRATISTA',10)->nullable();
            $table->string('NUMERO_SOLICITUD',25);
            $table->string('OBSERVACION_CONTRATO',25)->nullable();
            $table->string('PRE_FACTURA')->nullable();
            $table->string('FIRMA')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planillacertificados');
    }
}
