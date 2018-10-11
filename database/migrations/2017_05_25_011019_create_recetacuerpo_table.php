<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecetacuerpoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetaCuerpo', function (Blueprint $table) {
            $table->increments('idRecetaCuerpo');
            $table->integer('idReceta');
            $table->string('nombreMedicamento');
            $table->integer('dosis');
            $table->string('via');
            $table->integer('frecuencia');
            $table->integer('duracion');
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
        Schema::drop('recetaCuerpo');
    }
}
