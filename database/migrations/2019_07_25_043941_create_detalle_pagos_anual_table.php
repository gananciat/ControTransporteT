<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePagosAnualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pagos_anual', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pago_id');
            $table->unsignedBigInteger('propietario_linea_id');
            $table->decimal('total',11,2);
            $table->timestamps();
            $table->softDeletes();

             $table->foreign('pago_id')->references('id')->on('pagos');
             $table->foreign('propietario_linea_id')->references('id')->on('propietario_lineas');
        });
    }

    /**
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pagos_anual');
    }
}
