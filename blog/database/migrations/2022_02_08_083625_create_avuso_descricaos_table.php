<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvusoDescricaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avuso_descricaos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('asdescricao', 60)->nullable();
            $table->float('aivalor',8,2)->nullable();
            $table->char('asstatus', 14)->nullable();
            $table->unsignedInteger('avuso_id')->unsigned()->nullable();
            $table->foreign('avuso_id')->references('id')->on('avusos')->onDelete('cascade');
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
        Schema::dropIfExists('avuso_descricaos');
    }
}
