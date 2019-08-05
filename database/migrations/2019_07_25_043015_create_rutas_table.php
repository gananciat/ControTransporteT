<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ubicacion_id');
            $table->unsignedBigInteger('destino_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');
            $table->foreign('destino_id')->references('id')->on('destinos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutas');
    }
}
