<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampoPivoteTablaSolicituddocumento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicituddocumentos', function (Blueprint $table) {
            $table->integer('solicitudeproceso_id')->unsigned();
            $table->foreign('solicitudeproceso_id')->references('id')->on('solicitudeprocesos');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicituddocumentos', function (Blueprint $table) {
            $table->dropForeign('solicituddocumentos_solicitudeproceso_id_foreign');
            $table->dropColumn('solicitudeproceso_id');
        });
    }
}
