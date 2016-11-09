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

        $ResourceTime  = TimeTable::join('batch','TimeTable.batchNo','=','batch.id')->select('batch.*','TimeTable.year','TimeTable.subjectCode','TimeTable.timeSlot','TimeTable.day','TimeTable.resourceName','TimeTable.lecturerName')->where('resourceName','=',$hallNo)->get()->toArray();
        $fullTable      = TimeFormatTable::all();

  

        return view('timeTable.resourceTimetable')->with('fullTimeTable',$fullTable)->with('ResourceTimeDetails',$ResourceTime)->with('hallNo',$hallNo)->with('hallType',$hallType);
    }
}
