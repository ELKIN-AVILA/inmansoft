<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cargo_id');
            $table->string('priape',45);
            $table->string('segape',45)->nullable();
            $table->string('prinom',45);
            $table->string('segnom',45)->nullable();
            $table->string('correo',100);
            $table->bigInteger('celular');
            $table->foreign('cargo_id')->references('id')->on('cargo');
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
        Schema::dropIfExists('empleados');
    }
}
