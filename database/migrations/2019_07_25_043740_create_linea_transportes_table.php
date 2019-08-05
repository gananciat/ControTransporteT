<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineaTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linea_transportes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('linea_id');
            $table->unsignedbigInteger('transporte_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('linea_id')->references('id')->on('lineas');
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
        Schema::dropIfExists('propietario_linea_transportes');
    }
}
