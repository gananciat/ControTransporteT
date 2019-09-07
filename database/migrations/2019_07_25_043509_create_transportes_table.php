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
            $table->unsignedBigInteger('marca_transporte_id');
            $table->integer('no_tarjeta')->nullable();
            $table->integer('no_seguro')->nullable();
            $table->string('linea')->nullable();
            $table->string('no_motor')->nullable();
            $table->string('no_chasis')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('marca_transporte_id')->references('id')->on('marca_transportes');
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
