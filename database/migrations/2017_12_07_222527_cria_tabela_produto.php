<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->boolean('ativo')->default(0);
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('id_produto',100);
            $table->string('nome',200);
            $table->date('data_entregue_produto')->nullable();
            $table->date('data_prometido_pedido')->nullable();
            $table->date('data_SAC')->nullable();
            $table->string('link')->nullable();
            $table->string('loja_venda')->nullable();
            $table->string('id_pedido_marketplace')->nullable();
            $table->integer('marketplace_id')->unsigned();
            $table->foreign('marketplace_id')->references('id')->on('marketplaces');
            $table->integer('carteira_id')->unsigned();
            $table->foreign('carteira_id')->references('id')->on('carteiras');

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
        Schema::dropIfExists('produtos');
    }
}
