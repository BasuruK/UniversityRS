<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
//use Maatwebsite\Excel\Excel;
use Excel;
use DB;

class TimeTableController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ImportExport()
    {
        return view('timeTable.timeTable');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importExcel()
    {
        if(Input::hasFile('import_file'))
        {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value)
                {
                    $insert[] = ['day' => $value->day, 'timeslot' => $value->timeslot, 'resourceName' => $value->resourcename, 'lecturername' => $value->lecturername, 'subjectcode' => $value->subjectcode, 'year' => $value->year, 'batchno' => $value->batch];
                }
                if(!empty($insert))
                {
                    DB::table('timetable')->insert($insert);
                    dd('Records Inserted successfully!!!');
                }
            }
        }
        return back();

    }
}