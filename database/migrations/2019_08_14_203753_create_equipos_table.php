<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numplaca')->unique();
            $table->enum('estado',['A','I']);
            $table->unsignedBigInteger('tipequipo_id');
            $table->unsignedBigInteger('marcaequi_id');
            $table->unsignedBigInteger('modelequi_id');
            $table->string('serial',15);
            $table->date('fechacompra');
            $table->decimal('valcompra',10,2);
            $table->date('fechaegre')->nullable();
            $table->unsignedBigInteger('proveedores_id');
            $table->foreign('tipequipo_id')->references('id')->on('tipequipo');
            $table->foreign('marcaequi_id')->references('id')->on('marcaequi');
            $table->foreign('modelequi_id')->references('id')->on('modelequi');
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
        Schema::dropIfExists('equipos');
    }
}
