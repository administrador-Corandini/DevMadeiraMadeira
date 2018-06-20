<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    function marketplace (){
    	return $this->hasMany('App\marketplace');
    }

    function tipoEnvio (){
    	return $this->belongsTo('App\tipoEnvio');
    }
}
