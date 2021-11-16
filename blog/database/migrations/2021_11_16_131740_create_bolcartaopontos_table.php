<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBolcartaopontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bolcartaopontos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('bsentrada', 10)->nullable();
            $table->char('bssaida', 10)->nullable();
            $table->char('bsstatus', 10)->nullable();
            $table->float('bftotal',8,2)->nullable();
            $table->float('bfhoraex',8,2)->nullable();
            $table->float('bfhoraexcem',8,2)->nullable();
            $table->float('bfadinortuno',8,2)->nullable();
            $table->integer('trabalhador')->unsigned()->nullable();
            $table->foreign('trabalhador')->references('id')->on('trabalhadors');
            $table->integer('lancamento')->unsigned()->nullable();
            $table->foreign('lancamento')->references('id')->on('lancamentotabelas');
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
        Schema::dropIfExists('bolcartaopontos');
    }
}
