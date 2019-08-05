<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCambioLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambio_lineas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prop_anterior_id');
            $table->unsignedBigInteger('nuevo_propietario_id');
            $table->string('observacion',500);
            $table->timestamps();

            $table->foreign('prop_anterior_id')->references('id')->on('personas');
            $table->foreign('nuevo_propietario_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cambio_lineas');
    }
}
