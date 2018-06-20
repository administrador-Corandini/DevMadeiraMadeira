<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaCliente extends Migration
{

    public function up()
    {   
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('CPF',15)->unique();;
            $table->string('nome',130);
            $table->boolean('ativo')->default(0);
            //$table->integer('remessa_id')->unsigned()->default(0);
            //$table->foreign('remessa_id')->references('id')->on('remessa');
            $table->integer('situacao_id')->unsigned()->default(1);
            $table->foreign('situacao_id')->references('id')->on('situacoes');
            $table->integer('carteira_id')->unsigned();
            $table->foreign('carteira_id')->references('id')->on('carteiras');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::drop('clientes');
    }
}
