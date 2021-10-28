<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxaTrabalhadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxa_trabalhadors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tsferias')->nullable();
            $table->integer('tsdecimo13')->nullable();
            $table->integer('tsrsr')->nullable();
            $table->integer('das')->nullable();
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
        Schema::dropIfExists('taxa_trabalhadors');
    }
}
