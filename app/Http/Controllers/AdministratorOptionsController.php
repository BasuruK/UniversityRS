<?php

namespace App\Http\Controllers;

use App\Deadline;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications;
use App\Jobs\SendDeadlineEmail;
use Illuminate\Support\Facades\Auth;
use BackupManager\Manager;

class AdministratorOptionsController extends Controller
{
    /**
     * Displays the Administration Options page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $deadlines      = Deadline::all();
        $adminOptions   = DB::table('administrator_options')->first();

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
     * Truncates the Timetable table
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function truncateTimetable(Request $request)
    {
        if(!$request->ajax())
        {
            return redirect('/AdminOptions');
        }
        else
        {
            $exitCode = Artisan::call('truncate:Timetable');
            DB::table('requests')->truncate();
            DB::table('semester_requests')->truncate();
            DB::table('requests')->truncate();
            return back();
        }
    }

    /**
     * Clears only the entries specified by the batch and year
     *
     * @param Request $request
     * @param $batch
     * @param $year
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clearTimetableForBatchAndYear(Request $request,$batch,$year,$semesterRequestCheck,$formalRequestCheck)
    {
        //Check if the incoming request is AJAX, redirect if not
        if(!$request->ajax())
        {
            return redirect('/AdminOptions');
        }
        else
        {
            $batchID = $batchID = DB::table('batch')->where('year','=',$year)->where('batchNo','=',$batch)->value('id');
            DB::table('timetable')->where('year', '=', $year)->where('batchNo', '=', $batchID)->delete();

            if($semesterRequestCheck == true)
            {
                DB::table('semester_requests')->where('year', '=', $year)->where('batchNo', '=', $batchID)->where('status', '=', 'Accepted')->delete();
            }
            if($formalRequestCheck == true)
            {
                DB::table('requests')->where('year', '=', $year)->where('batchNo', '=', $batchID)->where('status', '=', 'Accepted')->delete();
            }
        }
    }


    /**
     *
     * Reset everything, including database.
     *
     * @param Request $request
     * @param $password
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function masterReset(Request $request,$password)
    {
        //Check if the incoming request is AJAX, redirect if not
        if(!$request->ajax())
        {
            return redirect('/AdminOptions');
        }
        else
        {
            //Authenticate the password
            if(Hash::check($password, Auth::user()->password))
            {
                Artisan::call('migrate:refresh', [
                    '--force' => true,
                    '--seed'  => true
                ]);
            }
            else
            {
                //Return false to indicate that password mismatch
                return json_encode(false);
            }
            //Return true to indicate the operation was success
            return json_encode(true);
        }
    }

    /**
     * Checks if the password matches with the Auth user password
     *
     * @param Request $request
     * @param $password
     * @return string
     */
    public function checkAuthenticity(Request $request,$password)
    {
        //Check if the incoming request is a AJAX request, redirect otherwise.
        if(!$request->ajax())
        {
            return redirect('/AdminOptions');
        }
        else
        {
            if (Hash::check($password, Auth::user()->password))
            {
                return json_encode(true);
            }
            else
            {
                return json_encode(false);
            }
        }
    }

    /**
     * creates a database backup file
     *
     * @return mixed
     */
    public function createDatabaseBackup()
    {
        $date           = Carbon::now()->toW3cString();
        $environment    = env('APP_ENV');

        Artisan::call('db:backup',[
            '--database'         => 'mysql',
            '--destination'      => 'local',
            '--destinationPath'  => 'databaseBackup/' . $date . ".sql",
            '--compression'      => 'gzip'
        ]);

	$headers = array(
		'Content-Type: application/gzip',
	);

	$file = "/home/forge/default/storage/app/databaseBackup/" . $date . ".sql.gz";
	return Response::download($file,'databasebackup.sql.gz',$headers);
    }

    /**
     * Restores the database, clears everything before restoring
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Manager $manager
     */
    public function databaseRestore(Request $request)
    {
        //Validate
        if(!$request->hasFile('dbSQL'))
        {
            return back()->withErrors(['Please select a file!']);
        }
        if(!$request->file('dbSQL')->isValid())
        {
            return back()->withErrors(['File upload failed!']);
        }
        if($request->file('dbSQL')->getClientOriginalExtension() != "gz")
        {
            return back()->withErrors(['Only .gz backup files are allowed!']);
        }

        $destination = "/home/forge/default/storage/app/databaseBackup/";
        //Move the file to the destination
        $request->file('dbSQL')->move($destination,"upload.sql.gz");

        //Clear the database
        Artisan::call('migrate:refresh', [
            '--force' => true
        ]);

        //migrate the uploaded backup file
        Artisan::call('db:restore',[
            '--database'      => 'mysql',
            '--source'	      => 'local',
            '--sourcePath'    => 'databaseBackup/upload.sql.gz',
            '--compression'   => 'gzip'

        ]);

        //remove the redundant backup file
        unlink("/home/forge/default/storage/app/databaseBackup/upload.sql.gz");

        return back();
    }

}
