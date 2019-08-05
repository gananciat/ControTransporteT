<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionPagoMultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_pago_multas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('causa_id');
            $table->unsignedBigInteger('revision_id');
            $table->timestamps();

            $table->foreign('causa_id')->references('id')->on('causas');

            $table->foreign('revision_id')->references('id')->on('revisiones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revision_pago_multas');
    }
}
