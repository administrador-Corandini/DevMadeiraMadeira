<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class marketplace extends Model
{
    function produto (){
    	return $this->hasMany('App\produto');
    }

    function tipoEnvio (){
    	return $this->hasMany('App\tipoEnvio');
    }
}
