<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->increments('id');
            $table->char('dsnome', 30)->nullable();
            $table->char('dstipo', 10)->nullable();
            $table->char('dssexo', 10)->nullable();
            $table->char('dsdata', 10)->nullable();
            $table->char('dscpf', 14)->nullable();
            $table->char('dsirrf', 20)->nullable();
            $table->char('dssf', 10)->nullable();
            $table->integer('trabalhador')->unsigned()->nullable();
            $table->foreign('trabalhador')->references('id')->on('trabalhadors');
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
        Schema::dropIfExists('dependentes');
    }
}
