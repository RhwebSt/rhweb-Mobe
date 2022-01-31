<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturaTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatura_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->char('fsdataincio', 15)->nullable();
            $table->char('fsdatafinal', 15)->nullable();
            $table->integer('fsnumero')->nullable();
            $table->float('fiindece',8,2)->nullable();
            $table->float('fivalor',8,2)->nullable();
            $table->integer('primario')->unsigned()->nullable();
            $table->foreign('primario')->references('id')->on('fatura_principals');
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
        Schema::dropIfExists('fatura_totals');
    }
}
