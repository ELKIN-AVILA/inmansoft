<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwarexequiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softwarexequipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipos_id');
            $table->unsignedBigInteger('versionpro_id');
            $table->string('licencia',100);
            $table->date('fechainst');
            $table->date('fechacaducid');
            $table->enum('estado',['A','N']);
            $table->foreign('equipos_id')->references('id')->on('equipos');
            $table->foreign('versionpro_id')->references('id')->on('version');
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
        Schema::dropIfExists('softwarexequipos');
    }
}
