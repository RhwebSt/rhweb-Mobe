<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvusosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avusos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('asinicial', 10)->nullable();
            $table->char('asfinal', 10)->nullable();
            $table->char('asnome', 60)->nullable();
            $table->char('ascpf', 15)->nullable();
            $table->float('aicodigo',8,2)->nullable();
            $table->float('ailiquido',8,2)->nullable();
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
        Schema::dropIfExists('avusos');
    }
}
