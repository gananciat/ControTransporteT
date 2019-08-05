<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo',25);
            $table->string('nombre_uno',25);
            $table->string('nombre_dos',25)->nullable();
            $table->string('apellido_uno',25);
            $table->string('apellido_dos',25)->nullable();
            $table->string('email')->nullable();
            $table->date('fecha_nac')->nullable();
            $table->unsignedBigInteger('tipo_persona_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('tipo_persona_id')->references('id')->on('tipo_personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propietarios');
    }
}
