<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\TimeFormatTable;
use Illuminate\Support\Facades\Auth;
use App\TimeTable;
use DB;
use Excel;

class userTimetableController extends Controller
{
    /**
     * returns the Timetable view with timetable data
     *
     * @return mixed
     */
    public function index()
    {
        $userName       = Auth::user()->name;
        $LecturerTimes  = TimeTable::where('lecturerName','=',$userName)->get()->toArray();
        $fullTable      = TimeFormatTable::all();

        return view('timeTable.lecturerTimetable')->with('fullTimeTable',$fullTable)->with('LecturesTimeDetails',$LecturerTimes);
    }

    public function viewTable(Request $request)
    {
        return json_encode("LOLOLOLO");
    }
}
