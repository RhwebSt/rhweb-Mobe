<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInssesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insses', function (Blueprint $table) {
            $table->increments('id');
            $table->char('isano', 10)->nullable();
            $table->char('isvalorinicial', 10)->nullable();
            $table->char('isvalorfinal', 10)->nullable();
            $table->char('isindece', 10)->nullable();
            $table->char('isreducao', 10)->nullable();
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
        Schema::dropIfExists('insses');
    }
}
