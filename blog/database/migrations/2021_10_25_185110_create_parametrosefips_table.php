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
            $table->char('psfpas', 11)->nullable();
            $table->char('psgrps', 11)->nullable();
            $table->char('psresol', 11)->nullable();
            $table->char('pscnae', 11)->nullable();
            $table->char('psfapaliquota', 11)->nullable();
            $table->char('psratajustados', 11)->nullable();
            $table->char('psfpasterceiros', 11)->nullable();
            $table->char('psaliquotaterceiros', 11)->nullable();
            $table->char('pssocial', 15)->nullable();
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
