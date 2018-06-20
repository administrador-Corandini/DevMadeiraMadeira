<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carteira extends Model
{
    public function produto(){
    	return $this->hasMany('App\produto');
    }
}
