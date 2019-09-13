<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineaChoferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linea_chofer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('linea_id');
            $table->unsignedBigInteger('chofer_id');
            $table->char('tipo_chofer',1)->default('T');
            $table->boolean('actual')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('linea_id')->references('id')->on('lineas');
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
