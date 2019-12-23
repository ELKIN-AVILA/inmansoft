<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransladoequipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transladoequip', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipos_id');
            $table->unsignedBigInteger('sedepro_id');
            $table->unsignedBigInteger('departamentospro_id');
            $table->unsignedBigInteger('dependenciaspro_id');
            $table->unsignedBigInteger('sedeactu_id');
            $table->unsignedBigInteger('departamentosactu_id');
            $table->unsignedBigInteger('dependenciasactu_id');
            $table->string('observacion',200);
            $table->foreign('equipos_id')->references('id')->on('equipos');
            $table->foreign('sedepro_id')->references('id')->on('sedes');
            $table->foreign('departamentospro_id')->references('id')->on('departamentos');
            $table->foreign('dependenciaspro_id')->references('id')->on('dependencias');
            $table->foreign('sedeactu_id')->references('id')->on('sedes');
            $table->foreign('departamentosactu_id')->references('id')->on('departamentos');
            $table->foreign('dependenciasactu_id')->references('id')->on('dependencias');
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
        Schema::dropIfExists('transladoequip');
    }
}
