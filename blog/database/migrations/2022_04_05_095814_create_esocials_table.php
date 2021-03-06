<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esocials', function (Blueprint $table) {
            $table->increments('id');
            $table->char('esnome', 100)->nullable();
            $table->char('escodigo', 60)->nullable();
            $table->char('esid', 100)->nullable();
            $table->integer('esambiente')->nullable();
            $table->char('esstatus', 30)->nullable();
            $table->char('esprenome ', 100)->nullable();
            $table->char('esinscricao ', 6)->nullable();
            $table->unsignedInteger('trabalhador_id')->unsigned()->nullable();
            $table->foreign('trabalhador_id')->references('id')->on('trabalhadors')->onDelete('cascade');
            $table->unsignedInteger('tomador_id')->unsigned()->nullable();
            $table->foreign('tomador_id')->references('id')->on('tomadors')->onDelete('cascade');
            $table->unsignedInteger('folhar_id')->unsigned()->nullable();
            $table->foreign('folhar_id')->references('id')->on('folhars')->onDelete('cascade');
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
        Schema::dropIfExists('esocials');
    }
}
