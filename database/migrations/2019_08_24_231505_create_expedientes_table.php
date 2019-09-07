<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('anio_id');
            $table->unsignedBigInteger('propietario_id');
            $table->string('expediente',150);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('propietario_id')->references('id')->on('personas');
            $table->foreign('anio_id')->references('id')->on('anios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expedientes');
    }
}
