<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturaRubricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatura_rubricas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('rsitem', 10)->nullable();
            $table->char('rsdescricao', 60)->nullable();
            $table->float('riunidade',8,2)->nullable();
            $table->float('ripreco',8,2)->nullable();
            $table->float('ritotal',8,2)->nullable();
            $table->integer('fatura')->unsigned()->nullable();
            $table->foreign('fatura')->references('id')->on('faturas');
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
        Schema::dropIfExists('fatura_rubricas');
    }
}
