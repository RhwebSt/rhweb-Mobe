<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentotabelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentotabelas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('liboletim', 50)->nullable();
            $table->char('lsdata', 10)->nullable();
            $table->char('lsnumero', 11)->nullable();
            $table->char('lsstatus', 2)->nullable();
            $table->char('lsferiado', 10)->nullable();
            $table->integer('tomador')->unsigned()->nullable();
            $table->foreign('tomador')->references('id')->on('tomadors');
            $table->integer('empresa')->unsigned()->nullable();
            $table->foreign('empresa')->references('id')->on('empresas');
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
        Schema::dropIfExists('lancamentotabelas');
    }
}
