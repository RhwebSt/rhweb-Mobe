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
            $table->float('isindece',8,2)->nullable();
            $table->float('isreducao',8,2)->nullable();
            $table->unsignedInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
