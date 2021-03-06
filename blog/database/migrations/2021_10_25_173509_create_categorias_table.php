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
            $table->char('cscategoria', 255)->nullable();
            $table->char('cssituacao',20)->nullable();
            $table->char('csadmissao', 10)->nullable();
            $table->char('csafastamento', 10)->nullable();
            $table->char('cbo', 255)->nullable();
            // $table->char('cssf', 18)->nullable();
            // $table->char('csirrf', 18)->nullable();
            $table->unsignedInteger('trabalhador_id')->unsigned()->nullable();
            $table->foreign('trabalhador_id')->references('id')->on('trabalhadors')->onDelete('cascade');
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
