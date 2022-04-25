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
            $table->unsignedInteger('tomador_id')->unsigned()->nullable();
            $table->foreign('tomador_id')->references('id')->on('tomadors')->onDelete('cascade');
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
