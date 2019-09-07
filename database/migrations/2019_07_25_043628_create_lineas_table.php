<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_linea');
            $table->unsignedBigInteger('ruta_id');
            $table->unsignedBigInteger('tipo_transporte_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ruta_id')->references('id')->on('rutas');
            $table->foreign('tipo_transporte_id')->references('id')->on('tipo_transportes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lineas');
    }
}
