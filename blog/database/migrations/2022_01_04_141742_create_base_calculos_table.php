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
            $table->unsignedInteger('trabalhador_id')->unsigned()->nullable();
            $table->foreign('trabalhador_id')->references('id')->on('trabalhadors')->onDelete('cascade');
            $table->unsignedInteger('tomador_id')->unsigned()->nullable();
            $table->foreign('tomador_id')->references('id')->on('tomadors')->onDelete('cascade');
            $table->unsignedInteger('folhar_id')->unsigned()->nullable();
            $table->foreign('folhar_id')->references('id')->on('folhars')->onDelete('cascade');
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
