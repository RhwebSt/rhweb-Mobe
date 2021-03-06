<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folhars', function (Blueprint $table) {
            $table->increments('id');
            $table->char('fscodigo', 10)->nullable();
            $table->char('fscompetencia', 10)->nullable();
            $table->char('fsinicio', 10)->nullable();
            $table->char('fsfinal', 10)->nullable();
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
        Schema::dropIfExists('folhars');
    }
}
