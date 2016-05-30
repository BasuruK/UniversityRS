<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch';
    
    protected $fillable = array('batchNo','year','noOfStudents');

    public function admin_requests()
    {
        $this->hasMany(Admin_Request::class);
    }
}
