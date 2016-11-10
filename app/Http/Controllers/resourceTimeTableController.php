<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeFormatTable;
use App\Http\Requests;
use App\TimeTable;
use DB;
use Excel;

class resourceTimeTableController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {

        $hallNo=$request->hallNo;
        $hallType=$request->hallType;

        $ResourceTime  = TimeTable::join('batch','timetable.batchNo','=','batch.id')->select('batch.*','timetable.year','timetable.subjectCode','timetable.timeSlot','timetable.day','timetable.resourceName','timetable.lecturerName')->where('resourceName','=',$hallNo)->get()->toArray();
        $fullTable     = TimeFormatTable::all();

  

        return view('timeTable.resourceTimetable')->with('fullTimeTable',$fullTable)->with('ResourceTimeDetails',$ResourceTime)->with('hallNo',$hallNo)->with('hallType',$hallType);
    }
}
