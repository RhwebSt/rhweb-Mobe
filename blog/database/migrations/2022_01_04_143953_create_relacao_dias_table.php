<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacaoDiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacao_dias', function (Blueprint $table) {
            $table->increments('id');
            $table->char('rsdia', 2)->nullable();
            $table->float('rivalor',8,2)->nullable();
            $table->unsignedInteger('trabalhador_id')->unsigned()->nullable();
            $table->foreign('trabalhador_id')->references('id')->on('trabalhadors')->onDelete('cascade');
            $table->unsignedInteger('base_calculo_id')->unsigned()->nullable();
            $table->foreign('base_calculo_id')->references('id')->on('base_calculos')->onDelete('cascade');
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
        Schema::dropIfExists('relacao_dias');
    }
}
