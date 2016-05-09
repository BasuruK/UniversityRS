<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allowed_User extends Model
{
  protected $fillable = ['staff_id','position'];
    
    public function user()
    {
        $this->hasOne('App\User');
    }
}
