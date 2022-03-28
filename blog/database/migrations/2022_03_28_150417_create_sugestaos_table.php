<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSugestaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sugestaos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('ssdescricao', 60)->nullable();
            $table->char('ssicon', 10)->nullable();
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
        Schema::dropIfExists('sugestaos');
    }
}
