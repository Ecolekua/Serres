<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposDtrabajadosnlocal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudeprocesos', function (Blueprint $table) {
            $table->integer('columnasDtrabajadosNlocalVisible')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitudeprocesos', function (Blueprint $table) {
            $table->dropColumn('columnasDtrabajadosNlocalVisible');
        });
    }
}
