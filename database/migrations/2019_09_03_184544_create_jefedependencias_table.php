<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJefedependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jefedependencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('departamentos_id');
            $table->unsignedBigInteger('dependencias_id');
            $table->unsignedBigInteger('empleados_id');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->foreign('departamentos_id')->references('id')->on('departamentos');
            $table->foreign('empleados_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('jefedependencias');
      
    }
}
