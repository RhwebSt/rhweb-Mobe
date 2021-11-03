<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBancariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancarios', function (Blueprint $table) {
            $table->increments('biid');
            $table->char('bstitular', 20)->nullable();
            $table->char('bsbanco', 15)->nullable();
            $table->char('bsagencia', 15)->nullable();
            $table->char('bsoperacao', 10)->nullable();
            $table->char('bsconta', 10)->nullable();
            $table->char('bspix', 50)->nullable();
            $table->char('bsdefaltor', 15)->nullable();
            $table->integer('trabalhador')->unsigned()->nullable();
            $table->foreign('trabalhador')->references('id')->on('trabalhadors');
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
        Schema::dropIfExists('bancarios');
    }
}
