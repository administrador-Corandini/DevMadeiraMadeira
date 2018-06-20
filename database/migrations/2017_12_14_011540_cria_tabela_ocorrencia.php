<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaOcorrencia extends Migration
{

    public function up()
    {
        Schema::create('ocorrencias', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->integer('situacao_id')->unsigned();
            $table->foreign('situacao_id')->references('id')->on('situacoes');
            $table->longText('ocorrencia');
            $table->string('user')->default('');
            $table->integer('tipo_ocorrencia_id')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ocorrencias');
    }
}
