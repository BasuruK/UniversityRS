<?php

namespace App\Http\Controllers;

use DB;
use Excel;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TimeFormatTable;
use App\TimeTable;


class TimeTableController extends Controller
{
    public function showGenerateTimetable()
    {
        return view('timetable.timeTable');
    }

    public function loadBatches()
    {
        $year= Input::get('option');
        $selectedbatch=\DB::table('batch')
            ->where('year',$year)
            ->orderBy('id', 'desc')
            ->lists('batchNo','id');

        return Response::json($selectedbatch);

    }

    public function show(Request $request)
    {

        $year= $request['selectyear'];
        $batch= $request['selectbatch'];
        $batchTimetableDetails = TimeTable::where([
            ['year', '=', $year],
            ['batchNo', '=', $batch]
        ])->get()->toArray();
        $fullTable = TimeFormatTable::all();

        return view('timeTable.batchTimetable')->with('fullTimeTable', $fullTable)->with('BatchTimeDetails', $batchTimetableDetails)->with('batch',$batch);

    }
    
}
