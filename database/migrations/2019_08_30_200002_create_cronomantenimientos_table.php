<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronomantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronomantenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',45);
            $table->unsignedBigInteger('usuarios_id');
            $table->date('fecha');
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
        Schema::dropIfExists('cronomantenimientos');
    }
}
