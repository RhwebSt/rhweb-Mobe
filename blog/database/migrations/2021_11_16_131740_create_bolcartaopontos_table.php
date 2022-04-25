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
            $table->char('bsentradamanhao', 10)->nullable();
            $table->char('bssaidamanhao', 10)->nullable();
            $table->char('bsentradatarde', 10)->nullable();
            $table->char('bssaidatarde', 10)->nullable();
            $table->char('bsentradanoite', 10)->nullable();
            $table->char('bssaidanoite', 10)->nullable();
            $table->char('bsentradamadrugada', 10)->nullable();
            $table->char('bssaidamadrugada', 10)->nullable();
            $table->char('horas_normais',10)->nullable();
            $table->char('bstotal',10)->nullable();
            $table->char('bshoraex',10)->nullable();
            $table->char('bshoraexcem',10)->nullable();
            $table->char('bsadinortuno',10)->nullable();
            $table->unsignedInteger('trabalhador_id')->unsigned()->nullable();
            $table->foreign('trabalhador_id')->references('id')->on('trabalhadors')->onDelete('cascade');
            $table->unsignedInteger('lancamento_id')->unsigned()->nullable();
            $table->foreign('lancamento_id')->references('id')->on('lancamentotabelas')->onDelete('cascade');
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
