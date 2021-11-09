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
            $table->float('rsinssempresa',8,2)->nullable();
            $table->integer('rstipoinssempresa')->nullable();
            $table->float('rsfgts',8,2)->nullable();
            $table->integer('rstipofgts')->nullable();
            $table->char('rsvalorfatura',15)->nullable();
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
