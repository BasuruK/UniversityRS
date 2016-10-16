<?php

namespace App\Http\Controllers;

use DB;
use Excel;
use Response;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Request;
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

    public function show()
    {

        $year= Input::get('selectyear');
        $batch= Input::get('selectbatch');
        $batchDetails = TimeTable::where([
            ['year', '=', $year],
            ['batchNo', '=', $batch]
        ])->get()->toArray();
        $fullTable = TimeFormatTable::all();

        return view('timeTable.lecturerTimetable')->with('fullTimeTable', $fullTable)->with('BatchTimeDetails', $batchDetails);

    }

    public function viewTable(Request $request)
    {
        return json_encode("LOLOLOLO");
    }
}
