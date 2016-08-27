<?php

namespace App\Http\Controllers;
use App\Admin_Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use App\Http\Requests;

class AdminRequestController extends Controller
{

    /**
     * @return view(view to be redirected,collection of requests)
     *
     * This function creates the collection of requests and pass the collection to the
     * Admin Request Management's main page.
     */

    public function show()
    {
        $requests = \DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('resource', 'requests.resourceID', '=', 'resource.hallNo')
            ->join('users', 'requests.lecturerID','=', 'users.staff_id')
            ->join('allowed_users', 'requests.lecturerID','=', 'allowed_users.staff_id')
            ->select('requests.*','subject.subName','resource.hallNo','users.name','allowed_users.position')
            ->orderby('allowed_users.position','asc')
            ->get();

        /*$c_requests = \DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('resource', 'requests.resourceID', '=', 'resource.id')
            ->join('users', 'requests.lecturerID','=', 'users.staff_id')
            ->select('requests.*','subject.subName','resource.hallNo','users.name')
            ->where('status','Pending')
            ->get();*/


        return view("adminRequests.admin_request_main",compact('requests'));
    }
    public function SortByBatchYear()
    {
        $requests = \DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('resource', 'requests.resourceID', '=', 'resource.hallNo')
            ->join('users', 'requests.lecturerID','=', 'users.staff_id')
            ->join('allowed_users', 'requests.lecturerID','=', 'allowed_users.staff_id')
            ->select('requests.*','subject.subName','resource.hallNo','users.name','allowed_users.position')
            ->orderby('requests.year','asc')
            ->orderby('requests.batchNo','asc')
            ->get();

        /*$c_requests = \DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('resource', 'requests.resourceID', '=', 'resource.id')
            ->join('users', 'requests.lecturerID','=', 'users.staff_id')
            ->select('requests.*','subject.subName','resource.hallNo','users.name')
            ->where('status','Pending')
            ->get();*/


        return view("adminRequests.admin_request_main",compact('requests'));
    }

    /**
     * @return to a new form
     */
    public function newForm()
    {
        $users = \DB::table('users')->get();
        $batches = \DB::table('batch')->get();
        $subjects = \DB::table('subject')->get();
        $resources = \DB::table('resource')->get();
        return view("adminRequests.admin_request_add", compact('batches','subjects','resources','users'));
    }

    /**
     * @param Request $request <- details of the new request from the form
     * @return to the main page
     *
     * This function creates an object from the Admin_Request model, then assign the values
     * received from the form and saves as a record in the database
     */
    public function add(Request $request)
    {

        $this->validate($request, [
            'selectdate'=>'required',
        ]);

        $Admin_Request= new Admin_Request();


        $Admin_Request->lecturerID=$request['selectstaff'];
        $Admin_Request->year=$request['selectyear'];
        $Admin_Request->batchNo=$request['selectbatch'];
        $Admin_Request->subjectCode=$request['selectsub'];
        $Admin_Request->timeSlot=$request['selecttimeslot'];
        $Admin_Request->requestDate=$request['selectdate'];
        $Admin_Request->resourceID=$request['selectres'];
        $Admin_Request->status=$request['selectstatus'];


        $Admin_Request->save();

        return Redirect::route('adminRequestShow');
    }

    /**
     * @param Admin_Request $admin_request <- record to be deleted
     * @return to the main page
     *
     * This function deletes the specified record passed as a parameter
     */
    public function delete(Admin_Request $admin_request)
    {
        Admin_Request::destroy($admin_request['id']);
        return redirect::route('adminRequestShow');
    }

    /**
     * @param Admin_Request $admin_request <- Request to be loaded to be edited
     * @return to the edit form
     *
     * This function takes the request to be edited as the parameter and pass along with
     * other collections as user,batch,subject and resource details to the edit form
     */
    public function edit(Admin_Request $admin_request)
    {
        $users=\DB::table('users')->get();
        $batches=\DB::table('batch')->get();
        $subjects=\DB::table('subject')->get();
        $resources=\DB::table('resource')->get();
        
        return view('adminRequests.admin_request_edit',compact('admin_request','batches','subjects','resources','users'));

    }

    /**
     * @param Request $request <- modified details from the form
     * @param Admin_Request $admin_request <- request to be updated
     * @return to the main view
     *
     * This function updates the record in the database with the modified values
     * taken from the edit form
     */
    public function update(Request $request, Admin_Request $admin_request)
    {
        $admin_request->lecturerID=$request['selectstaffEdit'];
        $admin_request->year=$request['selectyearEdit'];
        $admin_request->batchNo=$request['selectbatchEdit'];
        $admin_request->subjectCode=$request['selectsubEdit'];
        $admin_request->timeSlot=$request['selecttimeslotEdit'];
        $admin_request->requestDate=$request['selectdateEdit'];
        $admin_request->resourceID=$request['selectresEdit'];
        $admin_request->status=$request['selectStatusEdit'];
        $admin_request->save();

        return redirect::route('adminRequestShow');
    }

    /**
     * @param Admin_Request $admin_request <- details of the request
     * @return to the main view
     *
     * This functions takes the details of the request as the parameter, then extracts details
     * such as user email of the user who made the request and then creates the body of the request
     * and send an email to the user's email address
     */
    public function notify(Admin_Request $admin_request)
    {

        $user = \DB::table('users')
            ->select('users.*')
            ->where('users.staff_id','like',$admin_request->lecturerID)
            ->get();

        $user_request= \DB::table('requests')
            ->select('requests.*')
            ->where('requests.id','=',$admin_request->id)
            ->get();

        $user_email = array_pluck($user, 'email');
        $request_hall = array_pluck($user_request,'resourceID');
        $request_status = array_pluck($user_request,'status');
        $request_date = array_pluck($user_request,'requestDate');
        $request_timeslot = array_pluck($user_request,'timeSlot');
        


        Mail::send([], [], function ($message) use ($user_email,$request_hall,$request_status,$request_date,$request_timeslot) {
            $message->to($user_email)
                    ->subject('A Request Has Been Approved')

                    ->setBody('Your Request For
                               Resource: '.$request_hall[0].'
                               On: '.$request_date[0].'
                               For:  '.$request_timeslot[0].' Time Slot
                               is '.$request_status[0]);
        });


        return redirect::route('adminRequestShow');
    }
}
