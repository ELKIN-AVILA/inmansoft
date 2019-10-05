<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompoxequiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compoxequipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipos_id');
            $table->unsignedBigInteger('componentes_id');
            $table->foreign('equipos_id')->references('id')->on('equipos');
            $table->foreign('componentes_id')->references('id')->on('componentes');
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
        Schema::dropIfExists('compoxequipos');
    }
}
