<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTomadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tomadors', function (Blueprint $table) {
            $table->increments('id');
            $table->char('tsnome', 20)->nullable();
            $table->char('tsfantasia', 20)->nullable();
            $table->char('tscnpj', 19)->nullable();
            $table->char('tstelefone', 16)->nullable();
            $table->char('tsmatricula', 10)->nullable();
            $table->char('tssimples', 10)->nullable();
            $table->char('tstipo', 10)->nullable();
            $table->integer('user')->unsigned()->nullable();
            $table->foreign('user')->references('id')->on('users');
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
        Schema::dropIfExists('tomadors');
    }
}
