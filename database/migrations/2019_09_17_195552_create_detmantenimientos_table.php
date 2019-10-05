<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetmantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detmantenimiento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mantenimiento_id');
            $table->text('descripcion');
            $table->foreign('mantenimiento_id')->references('id')->on('mantenimientos');
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
        Schema::dropIfExists('detmantenimiento');
    }
}
