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
    public function index(Request $request)
    {

        $hallNo=$request->hallNo;
        $hallType=$request->hallType;
        $ResourceTime  = TimeTable::where('resourceName','=',$hallNo)->get()->toArray();
        $fullTable      = TimeFormatTable::all();

  

        return view('timeTable.resourceTimetable')->with('fullTimeTable',$fullTable)->with('ResourceTimeDetails',$ResourceTime)->with('hallNo',$hallNo)->with('hallType',$hallType);
    }
}
