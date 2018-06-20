<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaTelefones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefones',function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('telefone',12);
            $table->integer('status_id')->unsigned()->default(1);
            $table->foreign('status_id')->references('id')->on('status');
            $table->integer('wpp_id')->unsigned()->default(1);
            $table->foreign('wpp_id')->references('id')->on('wpps');
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
        Schema::dropIfExists('telefones');
    }
}
