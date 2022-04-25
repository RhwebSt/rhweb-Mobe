<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxas', function (Blueprint $table) {
            $table->increments('id');
            $table->float('tftaxaadm',8,2)->nullable();
            // $table->float('tfbenef',8,2)->nullable();
            // $table->float('tfferias',8,2)->nullable();
            // $table->float('tf13',8,2)->nullable();
            $table->char('tfdefaltor',100)->nullable();
            $table->float('tftaxafed',8,2)->nullable(); 
            $table->float('tfdas',8,2)->nullable();
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
        Schema::dropIfExists('taxas');
    }
}
