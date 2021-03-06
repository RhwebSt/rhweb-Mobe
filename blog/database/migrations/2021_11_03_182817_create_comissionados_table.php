<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissionadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comissionados', function (Blueprint $table) {
            $table->increments('id');
            $table->char('csmatricula', 10)->nullable();
            $table->char('csindece', 10)->nullable();
            $table->unsignedInteger('trabalhador_id')->unsigned()->nullable();
            $table->foreign('trabalhador_id')->references('id')->on('trabalhadors')->onDelete('cascade');
            $table->unsignedInteger('tomador_id')->unsigned()->nullable();
            $table->foreign('tomador_id')->references('id')->on('tomadors')->onDelete('cascade');
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
        Schema::dropIfExists('comissionados');
    }
}
