<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemesterRequests extends Model
{
    protected $table='semester_requests';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    //
}
