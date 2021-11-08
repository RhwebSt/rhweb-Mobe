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
            $table->float('tsferias',8,2)->nullable();
            $table->float('tsdecimo13',8,2)->nullable();
            $table->float('tsrsr',8,2)->nullable();
            $table->float('das',8,2)->nullable();
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
