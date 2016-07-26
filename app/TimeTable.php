<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    protected $table = "timetable";
    
    public $fillable = ['day','timeslot'];
}
