<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoferLineaTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chofer_linea_transportes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('linea_transporte_id');
            $table->unsignedBigInteger('chofer_id');
            $table->char('tipo_chofer',1)->default('T');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('linea_transporte_id')->references('id')->on('linea_transportes');
            $table->foreign('chofer_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chofer_propietario_linea_transportes');
    }
}
