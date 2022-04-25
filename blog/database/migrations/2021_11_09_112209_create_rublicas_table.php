<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRublicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rublicas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('rsrublica', 15)->nullable();
            $table->char('rsdescricao', 60)->nullable();
            $table->char('rsincidencia', 10)->nullable();
            $table->char('rsstatus', 10)->nullable();
            $table->char('rsdc', 14)->nullable();
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
        Schema::dropIfExists('rublicas');
    }
}
