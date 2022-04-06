<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposForaneosDeEstructura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estructuras', function (Blueprint $table) {
            $table->integer('proyecto_id')->unsigned();
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('formulario_id')->unsigned()->nullable();
            $table->foreign('formulario_id')->references('id')->on('formularios')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estructuras', function (Blueprint $table) {
            $table->dropForeign('estructuras_proyecto_id_foreign');
            $table->dropColumn('proyecto_id');
            $table->dropForeign('estructuras_formulario_id_foreign');
            $table->dropColumn('formulario_id');
        });
    }
}
