<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelaPrecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabela_precos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('tsano', 10)->nullable();
            $table->char('tsrubrica', 30)->nullable();
            $table->char('tsdescricao', 60)->nullable();
            $table->float('tsvalor',8,2)->nullable();
            $table->char('tsstatus', 10)->nullable();
            $table->float('tstomvalor',8,2)->nullable();
            $table->unsignedInteger('tomador_id')->unsigned()->nullable();
            $table->foreign('tomador_id')->references('id')->on('tomadors')->onDelete('cascade');
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
        Schema::dropIfExists('tabela_precos');
    }
}
