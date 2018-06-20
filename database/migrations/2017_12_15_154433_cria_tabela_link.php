<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaLink extends Migration
{
    
    public function up()
    {
        Schema::create('links', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('link_random');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('tipo_envio_id')->unsigned();
            $table->foreign('tipo_envio_id')->references('id')->on('tipo_envios');
            $table->string('destino');
            $table->string('id_produto');
            $table->string('id_markplace');
            $table->boolean('open')->default(0);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
