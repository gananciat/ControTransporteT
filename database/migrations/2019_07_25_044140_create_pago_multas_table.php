<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoMultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_multas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('descuento',11,2)->default(0);
            $table->unsignedBigInteger('causa_id');
            $table->unsignedBigInteger('tipo_multa_id');
            $table->unsignedBigInteger('linea_chofer_id');
            $table->unsignedBigInteger('empleado_id');
            $table->string('observacion',500);
            $table->timestamps();

            $table->foreign('causa_id')->references('id')->on('causas');
            $table->foreign('tipo_multa_id')->references('id')->on('tipo_multas');
            $table->foreign('linea_chofer_id')->references('id')->on('linea_chofer');
            $table->foreign('empleado_id')->references('id')->on('personas');
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
