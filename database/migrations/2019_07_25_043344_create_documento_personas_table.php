<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento',250);
            $table->unsignedBigInteger('tipo_documento_id');
            $table->unsignedBigInteger('persona_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos');
            $table->foreign('persona_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_propietarios');
    }
}
