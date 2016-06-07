<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin_Request extends Model
{
    protected $table='requests';

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
    /*
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'');
    }*/




}
