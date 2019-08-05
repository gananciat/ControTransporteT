<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('fecha');
            $table->unsignedBigInteger('tipo_revision_id');
            $table->unsignedBigInteger('linea_transporte_id');
            $table->unsignedBigInteger('empleado_id');
            $table->string('observacion',500);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('tipo_revision_id')->references('id')->on('tipo_revisiones');
            $table->foreign('linea_transporte_id')->references('id')->on('linea_transportes');
            $table->foreign('empleado_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisiones');
    }
}
