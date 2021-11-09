<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncideFolharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incide_folhars', function (Blueprint $table) {
            $table->increments('id');
            $table->float('insalimentacao',8,2)->nullable();
            $table->float('instransporte',8,2)->nullable();
            $table->integer('instipotrans')->nullable();
            $table->integer('instipoali')->nullable();
            $table->integer('tomador')->unsigned()->nullable();
            $table->foreign('tomador')->references('id')->on('tomadors');
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
        Schema::dropIfExists('incide_folhars');
    }
}
