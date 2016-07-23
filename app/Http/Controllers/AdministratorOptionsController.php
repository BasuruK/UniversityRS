<?php

namespace App\Http\Controllers;

use App\Deadline;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;

class AdministratorOptionsController extends Controller
{
    /**
     * Displays the Administration Options page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $Deadlines = Deadline::all();

        return view('administrator.AdministratorOptions')->with('Deadlines',$Deadlines);
    }

    public function sendMail()
    {
        $userData   = User::all();
        $dateData = Deadline::all()->last();
        $semester = $dateData->semester;
        $date     = $dateData->deadline;
        $year     = $dateData->year;
        
        foreach ($userData as $UserDetails)
        {
            $name   = $UserDetails->name;
            $email  = $UserDetails->email;

            Mail::send('email.deadlineNotification', ['date' => $date, 'semester' => $semester, 'year' => $year], function ($message) use($name,$email) {
                $message->from('notify.urscheduler@gmail.com','Admin');
                $message->to($email,$name);
                $message->subject('Deadline Notification');
            });
        }

      
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
            'semester' => 'required|max:5|min:1|numeric|digits:1',
            'year' => 'required|min:1',
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

    public function deadlineDelete(Deadline $id)
    {
        $id->delete();
        return back();
    }
    

}
