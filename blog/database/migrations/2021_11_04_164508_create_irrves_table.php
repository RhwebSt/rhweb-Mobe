<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrrvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irrves', function (Blueprint $table) {
            $table->increments('id');
            $table->char('irsano', 10)->nullable();
            $table->char('irdepedente',20)->nullable();
            $table->char('irsvalorinicial', 10)->nullable();
            $table->char('irsvalorfinal', 10)->nullable();
            $table->char('irsindece', 10)->nullable();
            $table->char('irsreducao', 10)->nullable();
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
        Schema::dropIfExists('irrves');
    }
}
