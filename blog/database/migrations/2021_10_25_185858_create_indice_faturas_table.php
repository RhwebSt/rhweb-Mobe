<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndiceFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indice_faturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('isalimentacao')->nullable();
            $table->integer('istransporte')->nullable();
            $table->char('isepi', 20)->nullable();
            $table->integer('isseguroportrabalhador')->nullable();
            $table->char('isindecesobrefolha', 15)->nullable();
            $table->char('isvaletransporte', 15)->nullable();
            $table->char('isvalealimentacao', 10)->nullable();
            $table->integer('tomador')->unsigned()->nullable();
            $table->foreign('tomador')->references('id')->on('tomadors');
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
        Schema::dropIfExists('indice_faturas');
    }
}
