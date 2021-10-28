<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetencaoFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retencao_faturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rsinssempresa')->nullable();
            $table->integer('rsfgts')->nullable();
            $table->integer('rsvalorfatura')->nullable();
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
        Schema::dropIfExists('retencao_faturas');
    }
}
