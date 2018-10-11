<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenauxiliarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenAuxiliar', function (Blueprint $table) {
            $table->increments('idExamenAuxiliar');
            $table->integer('idHistorial');
            $table->string('nombreExamen');
            $table->string('rutaImagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('examenAuxiliar');
    }
}
