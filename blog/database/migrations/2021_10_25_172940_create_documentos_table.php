<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dstipo')->nullable();
            $table->char('dsemisssao', 10)->nullable();
            $table->char('uf', 2)->nullable();
            $table->char('ctps', 20)->nullable();
            $table->char('pis', 20)->nullable();
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
        Schema::dropIfExists('documentos');
    }
}
