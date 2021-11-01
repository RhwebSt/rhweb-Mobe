<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('esnome', 15)->nullable();
            $table->char('escnpj', 15)->nullable();
            $table->char('esdataregitro', 10)->nullable();
            $table->char('esresponsavel', 20)->nullable();
            $table->char('esemail', 30)->nullable();
            $table->char('escnae', 10)->nullable();
            $table->char('escodigomunicipio', 10)->nullable();
            $table->char('essindicalizado', 5)->nullable();
            $table->char('esretemferias', 10)->nullable();
            $table->char('escondicaosindicato', 10)->nullable();
            $table->integer('user')->unsigned()->nullable();
            $table->foreign('user')->references('id')->on('users');
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
        Schema::dropIfExists('empresas');
    }
}
