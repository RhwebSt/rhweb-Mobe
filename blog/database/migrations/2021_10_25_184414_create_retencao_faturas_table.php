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
            $table->char('rstipoinssempresa',5)->nullable();
            $table->float('rsfgts',8,2)->nullable();
            $table->char('rstipofgts',5)->nullable();
            $table->char('rsvalorfatura',15)->nullable();
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
        Schema::dropIfExists('retencao_faturas');
    }
}
