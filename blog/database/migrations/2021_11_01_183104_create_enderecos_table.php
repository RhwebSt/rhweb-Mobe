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
            $table->increments('eiid');
            $table->char('escep', 16)->nullable();
            $table->char('eslogradouro', 150)->nullable();
            $table->char('esbairro', 150)->nullable();
            $table->char('esestado', 20)->nullable();
            // $table->char('estipo', 15)->nullable();
            $table->char('esmunicipio', 30)->nullable();
            $table->char('esuf', 2)->nullable();
            $table->char('escomplemento', 50)->nullable();
            $table->char('esnum', 10)->nullable();
            $table->unsignedInteger('trabalhador_id')->unsigned()->nullable();
            $table->foreign('trabalhador_id')->references('id')->on('trabalhadors')->onDelete('cascade');
            $table->unsignedInteger('tomador_id')->unsigned()->nullable();
            $table->foreign('tomador_id')->references('id')->on('tomadors')->onDelete('cascade');
            $table->unsignedInteger('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('pessoais_id')->unsigned()->nullable();
            $table->foreign('pessoais_id')->references('id')->on('pessoais')->onDelete('cascade');
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
