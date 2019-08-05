<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePagoMensualLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pago_mensual_lineas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pago_mensual_id');
            $table->unsignedBigInteger('propietario_linea_id');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('pago_mensual_id')->references('id')->on('detalle_pago_mensual');
            $table->foreign('propietario_linea_id')->references('id')->on('propietario_lineas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pago_mensual_lineas');
    }
}
