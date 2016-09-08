<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSemesterRequest extends Model
{
    protected $table='semester_requests';

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
