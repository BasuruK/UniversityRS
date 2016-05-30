<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userRequest extends Model
{
    protected $table='requests';
    
    public function users()
    {
         return $this->belongsTo(User::class);
    }
    
    
}
