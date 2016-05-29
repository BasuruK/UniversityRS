<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = "priority";

    public function allowedUserPriority()
    {
        return $this->belongsTo(Allowed_User::class,'id','position');
    }
}
