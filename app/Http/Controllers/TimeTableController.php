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
    /**
     * @return to the view of the timetable
     */
    public function showGenerateTimetable()
    {
        return view('timeTable.timeTable');
    }

    /**
     * @return batches availabe for the selected year
     */
    public function loadBatches()
    {
        $year= Input::get('option');
        $selectedbatch=\DB::table('batch')
            ->where('year',$year)
            ->orderBy('id', 'desc')
            ->lists('batchNo','id');

        return Response::json($selectedbatch);

    }

    /**
     * @param Request $request
     * @return $this
     */
    public function show(Request $request)
    {

        $year = $request['selectyear'];
        $batch = $request['selectbatch'];
        $typeFromDB = \DB::table('batch')
            ->select('type')
            -> where ([
                ['year',$year],
                ['batchNo',$batch]
            ])->first();
        $type = $typeFromDB->type;
        $batchTimetableDetails = TimeTable::where([
            ['year', '=', $year],
            ['batchNo', '=', $batch]
        ])->get()->toArray();
        $fullTable = TimeFormatTable::all();

        return view('timeTable.batchTimetable')->with('fullTimeTable', $fullTable)->with('BatchTimeDetails', $batchTimetableDetails)->with('batch',$batch)->with('type',$type);

    }
    
}
