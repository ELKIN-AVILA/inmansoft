<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('departamentos_id');
            $table->unsignedBigInteger('dependencias_id');
            $table->unsignedBigInteger('equipos_id');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->foreign('departamentos_id')->references('id')->on('departamentos');
            $table->foreign('dependencias_id')->references('id')->on('dependencias');
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
        Schema::dropIfExists('localizacion');
    }
}
