<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('placa',25);
            $table->integer('modelo');
            $table->string('marca',25)->nullable();
            $table->string('linea',25)->nullable();
            $table->integer('no_tarjeta')->nullable();
            $table->integer('no_seguro')->nullable();
            $table->unsignedBigInteger('tipo_transporte_id');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('transportes');
    }
}
