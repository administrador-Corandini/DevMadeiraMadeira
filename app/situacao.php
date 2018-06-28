<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class situacao extends Model
{
    protected $table = 'situacoes';

    public function carteira(){
        return $this->belongsTo('App\carteira');
    }
    
}
