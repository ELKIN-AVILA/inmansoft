<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelequisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelequi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',45);
            $table->unsignedBigInteger('marcaequi_id');
            $table->foreign('marcaequi_id')->references('id')->on('marcaequi');
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
        Schema::dropIfExists('modelequi');
    }
}
