<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente', function (Blueprint $table) {
            $table->increments('idPaciente');
            $table->string('apPaterno');
            $table->string('apMaterno');
            $table->string('nombres');
            $table->string('telefono');
            $table->string('direccion');
            $table->integer('edad');
            $table->string('dni');
            $table->string('estadoCivl');
            $table->string('antecedentes');
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
        Schema::drop('paciente');
    }
}
