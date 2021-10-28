<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->char('cscategoria', 20)->nullable();
            $table->char('cssituacao',10)->nullable();
            $table->char('csadmissao', 10)->nullable();
            $table->char('csafastamento', 10)->nullable();
            $table->char('cbo', 8)->nullable();
            $table->char('cssl', 10)->nullable();
            $table->char('csirrf', 10)->nullable();
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
        Schema::dropIfExists('categorias');
    }
}
