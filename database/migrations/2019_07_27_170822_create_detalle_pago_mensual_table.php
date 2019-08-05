<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePagoMensualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pago_mensual', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pago_id');
            $table->unsignedBigInteger('mes_id');
            $table->decimal('total',11,2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pago_id')->references('id')->on('pagos');
            $table->foreign('mes_id')->references('id')->on('mes');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pago_mensual');
    }
}
