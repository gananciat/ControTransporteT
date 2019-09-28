<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspecionesMultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspeciones_multas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inspeccion_id');
            $table->unsignedBigInteger('multa_id');
            $table->timestamps();

            $table->foreign('inspeccion_id')->references('id')->on('inspecciones')->onDelete('cascade');
            $table->foreign('multa_id')->references('id')->on('multas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspeciones_multas');
    }
}
