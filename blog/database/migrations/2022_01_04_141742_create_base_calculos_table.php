<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseCalculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_calculos', function (Blueprint $table) {
            $table->increments('id');
            $table->float('biservico',8,2)->nullable();
            $table->float('biservicodsr',8,2)->nullable();
            $table->float('biinss',8,2)->nullable();
            $table->float('bifgts',8,2)->nullable();
            $table->float('bifgtsmes',8,2)->nullable();
            $table->float('biirrf',8,2)->nullable();
            $table->float('bifaixairrf',8,2)->nullable();
            $table->float('binumfilhos',8,2)->nullable();
            $table->float('bitotaldiaria',8,2)->nullable();
            $table->float('bivalorliquido',8,2)->nullable();
            $table->float('bivalorvencimento',8,2)->nullable();
            $table->float('bivalordesconto',8,2)->nullable();
            $table->integer('trabalhador')->unsigned()->nullable();
            $table->foreign('trabalhador')->references('id')->on('trabalhadors');
            $table->integer('tomador')->unsigned()->nullable();
            $table->foreign('tomador')->references('id')->on('tomadors');
            $table->integer('folhar')->unsigned()->nullable();
            $table->foreign('folhar')->references('id')->on('folhars');
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
        Schema::dropIfExists('base_calculos');
    }
}
