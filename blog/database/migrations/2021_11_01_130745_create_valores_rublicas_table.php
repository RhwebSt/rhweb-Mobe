<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoresRublicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valores_rublicas', function (Blueprint $table) {
            $table->increments('id');
            // $table->char('vsvttrabalhador', 15)->nullable();
            // $table->char('vsvatrabalhador', 15)->nullable();
            $table->char('vsnrofatura', 15)->nullable();
            $table->char('vsreciboavulso', 15)->nullable();
            $table->char('vsmatricula', 15)->nullable();
            $table->char('vsnrorequisicao', 15)->nullable();
            $table->char('vsnroboletins', 15)->nullable();
            $table->char('vsnrofolha', 15)->nullable();
            $table->char('vsnrocartaoponto', 15)->nullable();
            $table->char('vsnroequesocial', 15)->nullable();
            $table->char('vscbo', 15)->nullable();
            $table->integer('vimatricular')->nullable();
            $table->integer('vimatriculartomador')->nullable();
            $table->unsignedInteger('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
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
        Schema::dropIfExists('valores_rublicas');
    }
}
