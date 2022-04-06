<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campovercertificado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuconformularios', function (Blueprint $table) {
            $table->integer('verCertificado')->unsigned()->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuconformularios', function (Blueprint $table) {
            $table->dropColumn('verCertificado');
        });
    }
}
