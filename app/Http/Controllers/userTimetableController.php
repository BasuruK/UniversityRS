<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LecturerTimetable;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\TimeTable;
use DB;
use MongoDB\BSON\Javascript;

class userTimetableController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->name;
        //$LecturerTimes = DB::table('timetable')->where('lecturerName','=',$userName)->get()->toArray();
        $LecturerTimes = TimeTable::where('lecturerName','=',$userName)->get()->toArray();

        //return $LecturerTimes;
        
        $fullTable = LecturerTimetable::all();
        return view('timeTable.lecturerTimetable')->with('fullTimeTable',$fullTable)->with('LecturesTimeDetails',$LecturerTimes);
    }
}
