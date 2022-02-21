<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosefipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametrosefips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('psfpas')->nullable();
            $table->integer('psconfpas')->nullable();
            $table->integer('psgrps')->nullable();
            $table->integer('psresol')->nullable();
            $table->integer('pscnae')->nullable();
            $table->float('psfapaliquota',8,2)->nullable();
            // $table->float('psrataaliquota',8,2)->nullable();
            $table->float('psratajustados',8,2)->nullable();
            $table->float('psfpasterceiros',8,2)->nullable();
            $table->float('psaliquotaterceiros',8,2)->nullable();
            // $table->char('pssocial', 15)->nullable();
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
        Schema::dropIfExists('parametrosefips');
    }
}
