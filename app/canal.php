<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class canal extends Model
{
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = strtoupper($value);
    }
}
