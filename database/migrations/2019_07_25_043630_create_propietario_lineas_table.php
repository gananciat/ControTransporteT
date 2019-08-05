<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropietarioLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propietario_lineas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('propietario_id');
            $table->unsignedBigInteger('linea_id');
            $table->boolean('actual')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('propietario_id')->references('id')->on('personas');

            $table->foreign('linea_id')->references('id')->on('tipo_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propietario_lineas');
    }
}
