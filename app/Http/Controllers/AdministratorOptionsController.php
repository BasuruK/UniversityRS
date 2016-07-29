<?php

namespace App\Http\Controllers;

use App\Deadline;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\SmsGateway;

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

    /**
     * If SemesterRequest checkbox is checked update or insert the variable to the database
     */
    public function semesterRequestChecked()
    {
        $alreadyFilledStatus = DB::table('administrator_options')->count();
        if($alreadyFilledStatus == 0)
        {
            DB::table('administrator_options')->insert([
                'semesterRequestForm' => '1'
            ]);
        }
        else
        {
            DB::table('administrator_options')
                ->where('id','1')
                ->update([
                    'semesterRequestForm' => '1'
                ]);
        }
    }

    /**
     * If SemesterRequest checkbox is unchecked update the variable to 0 on the database
     */
    public function semesterRequestUnchecked()
    {
        DB::table('administrator_options')
            ->where('id','1')
            ->update([
                'semesterRequestForm' => '0'
            ]);
    }

    /**
     * If SMS Notifications checkbox is checked update or insert the variable to the database
     */
    public function SMSNotificationChecked()
    {
        $alreadyFilledStatus = DB::table('administrator_options')->count();
        if($alreadyFilledStatus == 0)
        {
            DB::table('administrator_options')->insert([
                'SMSNotificationsForUsers' => '1'
            ]);
        }
        else
        {
            DB::table('administrator_options')
                ->where('id','1')
                ->update([
                    'SMSNotificationsForUsers' => '1'
                ]);
        }
    }

    /**
     * If SemesterRequest checkbox is unchecked update the variable to 0 on the database
     */
    public function SMSNotificationUnchecked()
    {
        DB::table('administrator_options')
            ->where('id','1')
            ->update([
                'SMSNotificationsForUsers' => '0'
            ]);
    }

    /**
     * Sends an SMS to the number specified
     *
     * @return mixed
     *
     */
    public function sendSMS()
    {
        $smsGateway = new SmsGateway('www.basururoxyouall@gmail.com','rrk10ict');

        $deviceID   = 26223;
        $number     = '+94773259133';
        $message    = 'Your request for SC400 on Wed 8.30 - 10.30 has been accepted';

        $result = $smsGateway->sendMessageToNumber($number,$message,$deviceID);

        return $result;

    }

}
