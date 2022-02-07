<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabalhadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabalhadors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tsnome',100)->nullable();
            $table->longText('tsfoto')->nullable();
            $table->string('tsnomesocial',100)->nullable();
            $table->string('tssocial',5)->nullable();
            $table->string('tscpf',15)->nullable();
            $table->integer('tsmatricula')->nullable();
            $table->integer('tsserie')->nullable();
            $table->string('tsmae',100)->nullable();
            // $table->string('pai',30)->nullable();
            $table->string('tsuf',2)->nullable();
            $table->string('tstelefone',18)->nullable();
            $table->string('tssexo',10)->nullable();
            $table->string('tsescolaridade',30)->nullable();
            $table->string('tsindice',20)->nullable();
            $table->string('tsirrf',10)->nullable();
            $table->integer('empresa')->unsigned()->nullable();
            $table->foreign('empresa')->references('id')->on('empresas');
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
        Schema::dropIfExists('trabalhadors');
    }
} 
