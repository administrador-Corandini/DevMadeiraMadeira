<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaCarteira extends Migration
{

    public function up()
    {
        Schema::create('carteiras', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nome');
            $table->integer('situacao_ficha_nova')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('carteiras');
    }
}
