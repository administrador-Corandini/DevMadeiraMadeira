<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agendaHora extends Model
{
    public function cliente(){
    	return $this->belongsTo('App\cliente');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
