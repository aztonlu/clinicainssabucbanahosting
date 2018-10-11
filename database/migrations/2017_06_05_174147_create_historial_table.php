<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historialMedico', function (Blueprint $table) {
            $table->increments('idHistorial');
            $table->string('dni');
            $table->date('fechaHistorial');
            $table->string('tiempoEnfermedad');
            $table->string('formaInicio');
            $table->string('curso');
            $table->string('signos');
            $table->string('relato');
            $table->string('examenFisico');
            $table->string('diagnostico');
            $table->string('tratamiento');
            $table->string('estado');
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
        Schema::drop('historialMedico');
    }
}
