<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('causas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',1000);
            $table->unsignedBigInteger('monto_multa_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('monto_multa_id')->references('id')->on('monto_multas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('causas');
    }
}
