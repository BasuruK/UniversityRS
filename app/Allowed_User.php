<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allowed_User extends Model
{
    protected $table = "allowed_users"; // explicit table name define, to be identified by Eloquent ORM
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
