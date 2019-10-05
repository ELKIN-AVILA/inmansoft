<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->unsignedBigInteger('cronomantenimiento_id')->nullable();
            $table->unsignedBigInteger('equipos_id');
            $table->unsignedBigInteger('tipmante_id')->nullable();
            $table->unsignedBigInteger('usuarios_id')->nullable();
            $table->enum('tipo',['P','N']);
            $table->foreign('cronomantenimiento_id')->references('id')->on('cronomantenimientos');
            $table->foreign('equipos_id')->references('id')->on('equipos');
            $table->foreign('tipmante_id')->references('id')->on('tipmante');
            $table->foreign('usuarios_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimientos');
    }
}
