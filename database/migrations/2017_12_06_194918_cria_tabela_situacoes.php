<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaSituacoes extends Migration
{

    public function up()
    {
         Schema::create('situacoes', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('nome');
            $table->integer('carteira_id')->unsigned();
            $table->foreign('carteira_id')->references('id')->on('carteiras');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::drop('situacoes');
    }
}
