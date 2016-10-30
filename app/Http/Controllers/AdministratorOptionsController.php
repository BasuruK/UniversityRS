<?php

namespace App\Http\Controllers;

use App\Deadline;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Notifications;
use App\Jobs\SendDeadlineEmail;

class AdministratorOptionsController extends Controller
{
    /**
     * Displays the Administration Options page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $deadlines = Deadline::all();
        $adminOptions = DB::table('administrator_options')->first();

        if($adminOptions == null)
        {
            $adminOptions = 999;
        }

        return view('administrator.AdministratorOptions')->with('Deadlines',$deadlines)->with('AdminOptions',$adminOptions);
    }

    /**
     * Sends a mail to all the users notifying the deadlines
     */
    public function sendMail()
    {
        $this->dispatch(new SendDeadlineEmail());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Saves the deadline
     */
    public function deadlineSave(Request $request)
    {
        $this->validate($request,[
            'semester'   => 'required|max:5|min:1|numeric|digits:1',
            'year'       => 'required|min:1',
            'datepicker' => 'required|date_format:m/d/Y'
        ]);
        
        $deadline           = new Deadline();
        $deadline->semester = $request['semester'];
        $deadline->year     = $request['year'];
        $deadline->deadline = $request['datepicker'];

        $deadline->save();
        $this->sendMail();

        return back();
    }

    /**
     * Deletes Deadlines
     * 
     * @param Deadline $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deadlineDelete(Deadline $id)
    {
        $id->delete();
        return back();
    }




//    Administrator options
    /**
     * If SemesterRequest checkbox is checked update or insert the variable to the database
     */
    public function semesterRequestChecked()
    {
        $alreadyFilledStatus = DB::table('administrator_options')->count();
        if($alreadyFilledStatus == 0)
        {
            DB::table('administrator_options')->insert([
                'semesterRequestForm' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        }
        else
        {
            DB::table('administrator_options')
                ->where('id','1')
                ->update([
                    'semesterRequestForm' => '1',
                    'updated_at' => Carbon::now()
                ]);
        }
        Notifications::sendNotification('Semester Form now Available',0 , 'semesterRequestFormNotification','/userRequest/requestFormSemester/');
    }

    /**
     * If SemesterRequest checkbox is unchecked update the variable to 0 on the database
     */
    public function semesterRequestUnchecked()
    {
        DB::table('administrator_options')
            ->where('id','1')
            ->update([
                'semesterRequestForm' => '0',
                'updated_at' => Carbon::now(),
            ]);

        //Delete the notification regarding the semester request table
        Notifications::where('type','semesterRequestFormNotification')->delete();
    }

    /**
     * Truncates the Timetable table in the database.
     */
    public function truncateTimetable()
    {
        $exitCode = Artisan::call('truncate:Timetable');

        return back();
    }

}
