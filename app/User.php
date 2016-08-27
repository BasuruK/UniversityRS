<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_id', 'name', 'email', 'password','admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
  
    /**
    * Checks when an Admin is logged in by checking the database column admin
    * @return boolean
    */
    public function isAdmin()
    {
        return (bool) $this->admin;
    }
    
    public function allowedUser()
    {
        return $this->belongsTo(Allowed_User::class,'staff_id','staff_id');
    }
    public function userRequests()
    {
        return $this->hasMany(userRequest::class);
    }

    public function messages()
    {
        return $this->hasMany(Messages::class);
    }
}
