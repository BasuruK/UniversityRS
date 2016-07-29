<?php

namespace App\Http\Controllers;

use App\TimeFormatTable;
use Illuminate\Support\Facades\Auth;
use App\TimeTable;
use DB;

class userTimetableController extends Controller
{
    public function index()
    {
        $userName       = Auth::user()->name;
        $LecturerTimes  = TimeTable::where('lecturerName','=',$userName)->get()->toArray();
        $fullTable      = TimeFormatTable::all();

        return view('timeTable.lecturerTimetable')->with('fullTimeTable',$fullTable)->with('LecturesTimeDetails',$LecturerTimes);
    }
}
