<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ocorrencia extends Model
{
    /*public function cliente(){
    	return $this->belongsTo('App\cliente');
    }*/
    public function situacao(){
    	return $this->belongsTo('App\situacao');
    }
}
