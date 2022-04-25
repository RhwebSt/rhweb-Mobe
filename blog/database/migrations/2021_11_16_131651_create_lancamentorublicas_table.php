<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentorublicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentorublicas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('lshistorico', 60)->nullable();
            $table->char('lsquantidade', 11)->nullable();
            $table->integer('licodigo')->nullable();
            $table->char('lsdescricao', 100)->nullable();
            $table->float('lfvalor',8,2)->nullable();
            $table->float('lftomador',8,2)->nullable();
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
        Schema::dropIfExists('lancamentorublicas');
    }
}
