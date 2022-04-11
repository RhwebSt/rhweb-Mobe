<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasseSegundasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classe_segundas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cscodigo')->nullable();
            $table->char('csdescricao', 100)->nullable();
            $table->integer('classes')->unsigned()->nullable();
            $table->foreign('classes')->references('id')->on('classes');
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
        Schema::dropIfExists('classe_segundas');
    }
}
