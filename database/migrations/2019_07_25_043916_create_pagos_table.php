<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('propietario_linea_id');
            $table->unsignedBigInteger('concepto_pago_anio_id');
            $table->decimal('total',11,2);
            $table->boolean('anulado')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propietario_linea_id')->references('id')->on('propietario_lineas');
            $table->foreign('concepto_pago_anio_id')->references('id')->on('concepto_pago_anios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
