<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNascimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nascimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('nsnascimento', 10)->nullable();
            $table->char('nscivil', 15)->nullable();
            $table->char('nsnaturalidade', 60)->nullable();
            $table->char('nsnacionalidade', 60)->nullable();
            $table->char('nsraca', 10)->nullable();
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
        Schema::dropIfExists('nascimentos');
    }
}
