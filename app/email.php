<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class email extends Model
{
    public function cliente(){
    	return $this->belongsTo('App\cliente');
    }
}
