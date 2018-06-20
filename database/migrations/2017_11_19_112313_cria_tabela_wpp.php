<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaWpp extends Migration
{

    public function up()    {
        Schema::create('wpps',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nome');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wpps');
    }
}
