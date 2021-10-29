<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('escep', 16)->nullable();
            $table->char('eslogradouro', 30)->nullable();
            $table->char('esbairro', 20)->nullable();
            $table->char('esestado', 20)->nullable();
            $table->char('estipo', 10)->nullable();
            $table->char('esmunicipio', 20)->nullable();
            $table->char('esuf', 2)->nullable();
            $table->char('escomplemento', 50)->nullable();
            $table->char('esnum', 10)->nullable();
            $table->integer('trabalhador')->unsigned()->nullable();
            $table->foreign('trabalhador')->references('id')->on('trabalhadors');
            $table->integer('tomador')->unsigned()->nullable();
            $table->foreign('tomador')->references('id')->on('tomadors');
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
        Schema::dropIfExists('enderecos');
    }
}
