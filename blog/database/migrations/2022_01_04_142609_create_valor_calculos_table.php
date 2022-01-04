<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorCalculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_calculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vicodigo')->nullable();
            $table->char('vsdescricao', 50)->nullable();
            $table->float('vireferencia',8,2)->nullable();
            $table->float('vivencimento',8,2)->nullable();
            $table->float('videscinto',8,2)->nullable();
            $table->integer('basecalculo')->unsigned()->nullable();
            $table->foreign('basecalculo')->references('id')->on('base_calculos');
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
        Schema::dropIfExists('valor_calculos');
    }
}
