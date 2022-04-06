<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampoForaneoSolicitudCerradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudcerradas', function (Blueprint $table) {
            $table->integer('usuconformulario_id')->unsigned();
            $table->foreign('usuconformulario_id')->references('id')->on('usuconformularios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitudcerradas', function (Blueprint $table) {
            $table->dropForeign('solicitudcerradas_usuconformulario_id_foreign');
            $table->dropColumn('usuconformulario_id');
        });
    }
}
