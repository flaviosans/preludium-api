<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventosPessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('evento_pessoa', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('evento_id')->unsigned();
          $table->integer('pessoa_id')->unsigned();
          $table->foreign('evento_id')->references('id')->on('eventos');
          $table->foreign('pessoa_id')->references('id')->on('pessoas');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_pessoa');
    }
}
