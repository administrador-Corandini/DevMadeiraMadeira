<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ocorrencia extends Model
{
    public function situacao(){
    	return $this->belongsTo('App\situacao');
    }

    public function getCreatedAtAttribute($value){
        return date("d/m/Y h:i:s",strtotime($value));
    }

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function canal(){
        return $this->belongsTo('App\canal');
    }


}
