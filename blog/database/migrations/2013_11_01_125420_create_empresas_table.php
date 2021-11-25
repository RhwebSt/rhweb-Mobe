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
            $table->char('esnome', 100)->nullable();
            $table->char('escnpj', 30)->nullable();
            $table->char('esdataregitro', 30)->nullable();
            $table->char('esresponsavel', 30)->nullable();
            $table->char('esemail', 100)->nullable();
            $table->char('escnae', 30)->nullable();
            $table->char('escodigomunicipio', 30)->nullable();
            $table->char('essindicalizado', 30)->nullable();
            $table->char('esretemferias', 10)->nullable();
            $table->char('escondicaosindicato', 10)->nullable();
           
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
