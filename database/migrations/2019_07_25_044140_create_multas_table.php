<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_multa');
            $table->unsignedBigInteger('causa_id');
            $table->unsignedBigInteger('tipo_multa_id');
            $table->unsignedBigInteger('linea_chofer_id');
            $table->unsignedBigInteger('transporte_id');
            $table->unsignedBigInteger('agente_id');
            $table->date('fecha_multa');
            $table->date('fecha_pago')->nullable();
            $table->boolean('pagado')->default(0);
            $table->boolean('fuera_de_tiempo')->default(0);
            $table->decimal('total_pagado',11,2)->default(0);
            $table->decimal('total_a_pagar',11,2);
            $table->decimal('descuento',11,2)->default(0)->nullabe();
            $table->string('observacion',500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('causa_id')->references('id')->on('causas');
            $table->foreign('tipo_multa_id')->references('id')->on('tipo_multas');
            $table->foreign('linea_chofer_id')->references('id')->on('linea_chofer');
            $table->foreign('agente_id')->references('id')->on('personas');
            $table->foreign('transporte_id')->references('id')->on('transportes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_multas');
    }
}
