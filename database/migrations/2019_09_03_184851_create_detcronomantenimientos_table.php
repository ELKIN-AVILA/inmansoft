<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetcronomantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detcronomantenimiento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cronomantenimiento_id');
            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('departamentos_id');
            $table->unsignedBigInteger('dependencias_id');
            $table->unsignedBigInteger('jefedependencia_id');
            $table->date('fechaini');
            $table->date('fechafin');
            $table->enum('estado',['P','E','F']);
            $table->integer('numequipo');
            $table->foreign('cronomantenimiento_id')->references('id')->on('cronomantenimientos');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->foreign('departamentos_id')->references('id')->on('departamentos');
            $table->foreign('dependencias_id')->references('id')->on('dependencias');
            $table->foreign('jefedependencia_id')->references('id')->on('jefedependencias');
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
        Schema::dropIfExists('detcronomantenimiento');

    }
}
