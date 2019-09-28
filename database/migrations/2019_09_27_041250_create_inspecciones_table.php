<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspecciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero');
            $table->unsignedBigInteger('transporte_id');
            $table->unsignedBigInteger('agente_id');
            $table->datetime('fecha');
            $table->boolean('total_llantas')->default(0);
            $table->boolean('platos')->default(0);
            $table->boolean('retrovisores')->default(0);
            $table->boolean('antena')->default(0);
            $table->boolean('silvines')->default(0);
            $table->boolean('stops')->default(0);
            $table->boolean('tricket')->default(0);
            $table->boolean('herramienta')->default(0);
            $table->boolean('placas')->default(0);
            $table->boolean('radio')->default(0);
            $table->boolean('bocinas_radio')->default(0);
            $table->boolean('vidrios')->default(0);
            $table->boolean('tapon_conbustible')->default(0);
            $table->boolean('tapon_radiadior')->default(0);
            $table->boolean('plumillas')->default(0);
            $table->boolean('alfombras')->default(0);
            $table->boolean('pidevias')->default(0);
            $table->boolean('reproductor')->default(0);
            $table->string('otros_accesorios',500)->nullable();
            $table->string('daños',500)->nullable();
            $table->string('observacion',500)->nullable();
            $table->timestamps();

            $table->foreign('transporte_id')->references('id')->on('transportes')->onDelete('cascade');
            $table->foreign('agente_id')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspeciones');
    }
}
