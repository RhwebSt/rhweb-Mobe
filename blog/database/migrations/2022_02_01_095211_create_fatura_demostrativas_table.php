<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturaDemostrativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatura_demostrativas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('dsdescricao', 50)->nullable();
            $table->float('fiindece',8,2)->nullable();
            $table->float('fivalor',8,2)->nullable();
            $table->unsignedInteger('fatura_id')->unsigned()->nullable();
            $table->foreign('fatura_id')->references('id')->on('faturas')->onDelete('cascade');
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
        Schema::dropIfExists('fatura_demostrativas');
    }
}
