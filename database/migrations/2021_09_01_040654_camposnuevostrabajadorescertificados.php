<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Camposnuevostrabajadorescertificados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleadoscertificados', function (Blueprint $table) {
            $table->integer('diasTrabajados')->nullable()->unsigned();
            $table->string('numeroLocal',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleadoscertificados', function (Blueprint $table) {
             $table->dropColumn('diasTrabajados');
            $table->dropColumn('numeroLocal');
        });
    }
}
