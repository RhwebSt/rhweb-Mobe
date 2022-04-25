<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eiquantidade')->nullable();
            $table->char('esdescricao', 60)->nullable();
            $table->char('estm', 5)->nullable();
            $table->integer('eica')->nullable();
            $table->char('esdatares', 10)->nullable();
            $table->char('esdatadev', 10)->nullable();
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
        Schema::dropIfExists('epis');
    }
}
