<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassePrimeirasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classe_primeiras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cscodigo')->nullable();
            $table->char('csdescricao', 100)->nullable();
            $table->unsignedInteger('classes_id')->unsigned()->nullable();
            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('cascade');
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
        Schema::dropIfExists('classe_primeiras');
    }
}
