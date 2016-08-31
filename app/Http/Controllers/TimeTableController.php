<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
//use Maatwebsite\Excel\Excel;
use Excel;
use DB;
use Validator;

class TimeTableController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * time table upload view
     */
    public function ImportExport()
    {
        return view('timeTable.timeTable');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * to store the timetable using an excel sheet
     */
    public function importExcel(Request $request)
    {
        $rules = array(

                'import_file'          => 'required|mimes:xls,xlsx'
        );

        $validator = Validator::make(Input::only('import_file'),$rules);

        if($validator->fails())
        {
            $request->session()->flash('alert-danger', 'Only Excel files can be uploaded');
            return back()->withErrors($validator);
        }

        else
        {
            if (Input::hasFile('import_file'))
            {

                $path = Input::file('import_file')->getRealPath();
                $data = Excel::load($path, function ($reader) {
                })->get();
                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {

                        $insert[] = ['day' => $value->day, 'timeslot' => $value->timeslot, 'resourcename' => $value->resourcename, 'lecturername' => $value->lecturername, 'subjectcode' => $value->subjectcode, 'year' => $value->year, 'batchno' => $value->batch];
                    }
                    if (!empty($insert)) {
                        DB::table('timetable')->insert($insert);
                        $request->session()->flash('alert-success', 'Timetable was successful added!');
                        return back();
                    }
                }
            }
            return back();
        }

    }
}
