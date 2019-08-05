<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptoPagoAniosTable extends Migration
{
    public function up()
    {
        Schema::create('concepto_pago_anios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('anio_id');
            $table->unsignedBigInteger('concepto_pago_id');
            $table->decimal('cuota',11,2);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('anio_id')->references('id')->on('anios');
            $table->foreign('concepto_pago_id')->references('id')->on('concepto_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concepto_pago_anios');
    }
}
