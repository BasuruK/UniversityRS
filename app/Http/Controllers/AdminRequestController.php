<?php

namespace App\Http\Controllers;
use App\Admin_Request;
use App\AdminSemesterRequest;
use App\TimeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Input;
use DB;

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

    //Semester Requests Functions

    public function showSemesterRequests()
    {
        $semesterRequests = \DB::table('semester_requests')
            ->join('subject', 'semester_requests.subjectCode', '=', 'subject.id')
            ->join('batch', 'semester_requests.batchNo', '=', 'batch.id')
            ->join('users','semester_requests.lecturerID','=', 'users.staff_id')
            ->select('semester_requests.*','subject.subName','batch.batchNo','users.name')
            ->where('semester_requests.status','!=','Accepted')
            ->get();
        $acceptedSemesterRequests=\DB::table('semester_requests')
            ->join('subject', 'semester_requests.subjectCode', '=', 'subject.id')
            ->join('users','semester_requests.lecturerID','=', 'users.staff_id')
            ->join('batch', 'semester_requests.batchNo', '=', 'batch.id')
            ->select('semester_requests.*','subject.subName','batch.batchNo','users.name')
            ->where('semester_requests.status','=','Accepted')
            ->get();


        return view('adminRequests.adminSemesterRequestView',compact('semesterRequests','acceptedSemesterRequests'));
    }

    public function deleteSemesterRequest(AdminSemesterRequest $adminSemesterRequest)
    {
        AdminSemesterRequest::destroy($adminSemesterRequest['id']);
        return redirect::to('/adminRequest/semesterRequest');
    }

    public function editSemesterRequest(AdminSemesterRequest $adminSemesterRequest)
    {
        $batch=\DB::table('batch')
            ->select('batch.batchNo')
            ->where('id',$adminSemesterRequest->batchNo)
            ->first();

        $resources=\DB::table('resource')->get();

        $selectedSub=DB::table('subject')
            ->select('subject.subCode','subject.subName')
            ->where('id',$adminSemesterRequest->subjectCode)
            ->first();

        $requestedUser=DB::table('users')
            ->select('users.id','users.name')
            ->where('staff_id',$adminSemesterRequest->lecturerID)
            ->first();

        return view('adminRequests.adminSemesterRequestEdit',compact('adminSemesterRequest','requestedUser','batch','selectedSub'));
    }

    public function updateSemesterRequest(Request $request,AdminSemesterRequest $adminSemesterRequest)
    {
        $adminSemesterRequest->requestDate=$request['selectdateEdit'];
        $adminSemesterRequest->timeSlot=$request['selectTimeEdit'];
        $adminSemesterRequest->resourceID=$request['selectResources'];
        $adminSemesterRequest->status='Accepted';

        $adminSemesterRequest->save();

        $timetable= new TimeTable();


        $timetable->year=$adminSemesterRequest['year'];
        $timetable->batchNo=$adminSemesterRequest['batchNo'];
        $timetable->subjectCode=$request['subName'];
        $timetable->timeSlot=$adminSemesterRequest['timeSlot'];
        $timetable->day=$request['selectdateEdit'];
        $timetable->resourceName=$request['selectResources'];
        $timetable->lecturerName=$request['reqLect'];

        $timetable->save();



        return redirect::route('adminSemesterRequest');
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

    public function loadSubjects()
    {
        $year= Input::get('option');
        $selectedSubject=\DB::table('subject')
            ->where('year',$year)
            ->orderBy('id', 'desc')
            ->lists('subName','id');

        return Response::json($selectedSubject);
    }


    public function loadAvailableResourcesDate()
    {
        $time= Input::get('option2');
        $date= Input::get('option');

        $nonAvailableHalls=\DB::table('semester_requests')
            ->select('resourceID')
            ->where('status','=','Accepted')
            ->where('requestDate','=',$date)
            ->where('timeSlot','=',$time)
            ->lists('resourceID');

        $availableHalls=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls)
            ->orderBy('id', 'desc')
            ->lists('type','hallNo');

        return Response::json($availableHalls);
    }

    public function loadAvailableResourcesTime()
    {
        $time = Input::get('option');
        $date = Input::get('option2');

        $nonAvailableHalls=\DB::table('semester_requests')
            ->select('resourceID')
            ->where('status','=','Accepted')
            ->where('requestDate','=',$date)
            ->where('timeSlot','=',$time)
            ->lists('resourceID');

        $availableHalls=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls)
            ->orderBy('id', 'desc')
            ->lists('type','hallNo');


        return Response::json($availableHalls);
    }
}
