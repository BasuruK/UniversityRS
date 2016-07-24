<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LecturerTimetable;
use App\Http\Requests;

class userTimetableController extends Controller
{
    public function index()
    {
        $fullTable = LecturerTimetable::all();
        return view('timeTable.lecturerTimetable')->with('fullTimeTable',$fullTable);
    }
}
