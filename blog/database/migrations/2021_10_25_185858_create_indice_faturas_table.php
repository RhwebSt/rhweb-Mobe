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
            $table->float('isalimentacao',8,2)->nullable();
            $table->float('istransporte',8,2)->nullable();
            $table->float('isepi',8,2)->nullable();
            $table->float('isseguroportrabalhador',8,2)->nullable();
            $table->char('isindecesobrefolha', 15)->nullable();
            $table->float('isvaletransporte',8,2)->nullable();
            $table->float('isvalealimentacao',8,2)->nullable();
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
        Schema::dropIfExists('indice_faturas');
    }
}
