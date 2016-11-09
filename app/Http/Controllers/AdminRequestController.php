<?php

namespace App\Http\Controllers;
use App\Admin_Request;
use App\AdminSemesterRequest;
use App\TimeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Input;
use DB;

class AdminRequestController extends Controller
{
    /**
     * Formal Request Management Methods
     */

    /**
     * This function creates the collection of requests and pass the collection to the
     * Admin Request Management's main page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $requests = \DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('batch', 'requests.batchNo', '=', 'batch.id')
            ->join('users','requests.lecturerID','=', 'users.staff_id')
            ->join('allowed_users', 'requests.lecturerID','=', 'allowed_users.staff_id')
            ->select('requests.*','subject.subName','batch.batchNo','users.name','allowed_users.position')
            ->where('requests.status','!=','Accepted')
            ->where('requests.specialEvent',NULL)
            ->orderBy('requests.year','asc')
            //->orderBy('batch.batchNo','asc')
            //->orderBy('allowed_users.position','asc')
            ->get();

        $acceptedrequests=\DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('users','requests.lecturerID','=', 'users.staff_id')
            ->join('batch', 'requests.batchNo', '=', 'batch.id')
            ->select('requests.*','subject.subName','batch.batchNo','users.name')
            ->where('requests.status','=','Accepted')
            ->where('requests.specialEvent',NULL)
            //->orderBy('requests.year')
            //->orderBy('requests.batchNo')
            ->get();

        return view("adminRequests.adminRequestMain")->with('requests',$requests)->with('acceptedrequests',$acceptedrequests);
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


        return view("adminRequests.adminRequestMain",compact('requests'));
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

        $batch=\DB::table('batch')
            ->select('batch.batchNo')
            ->where('id',$admin_request->batchNo)
            ->first();


        $selectedSub=DB::table('subject')
            ->select('subject.subCode','subject.subName')
            ->where('id',$admin_request->subjectCode)
            ->first();

        $requestedUser=DB::table('users')
            ->select('users.id','users.name')
            ->where('staff_id',$admin_request->lecturerID)
            ->first();

        list($year,$month,$day,$dayName) = explode("-",$admin_request->requestDate);

        $dateFinal="test";
        if($dayName=="Mon")
            $dateFinal="monday";
        else if ($dayName=="Tue")
            $dateFinal="tuesday";
        else if ($dayName=="Wed")
            $dateFinal="wednesday";
        else if ($dayName=="Thu")
            $dateFinal="thursday";
        else if ($dayName=="Fri")
            $dateFinal="friday";
        else if ($dayName=="Sat")
            $dateFinal="saturday";
        else if ($dayName=="Sun")
            $dateFinal="sunday";

        list($firsttime, $dash, $lasttime) = explode(" ",$admin_request->timeSlot);

        /**
         * checking in the semester requests table
         */
        $nonAvailableHalls_semester=\DB::table('semester_requests')
            ->select('resourceID')
            ->where([
                ['status','=','Accepted'],
                ['requestDate','=',$dateFinal],
                ['timeSlot','LIKE',$firsttime .'%'],
            ])
            ->orWhere([
                ['status','=','Accepted'],
                ['requestDate','=',$dateFinal],
                ['timeSlot','LIKE','%'.$lasttime],
            ])
            ->lists('resourceID');

        $availableHalls_semester=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls_semester)
            ->where('type','LIKE',$admin_request->ResourceType)
            ->orderBy('id', 'desc')
            ->lists('hallNo');

        /**
         * checking formal requests in the requests table
         */
        $nonAvailableHalls_formal=\DB::table('requests')
            ->select('resourceID')
            ->where([
                ['status','=','Accepted'],
                ['requestDate','=',$admin_request->requestDate],
                ['timeSlot','LIKE',$firsttime .'%'],
                ['specialEvent',NULL],
            ])
            ->orWhere([
                ['status','=','Accepted'],
                ['requestDate','=',$admin_request->requestDate],
                ['timeSlot','LIKE','%'.$lasttime],
                ['specialEvent',NULL],
            ])
            ->lists('resourceID');

        $availableHalls_formal=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls_formal)
            ->where('type','LIKE',$admin_request->ResourceType)
            ->orderBy('id', 'desc')
            ->lists('hallNo');

        /**
         * Checking the special event requests in the requests table
         */

        $specialRequests=\DB::table('requests')
            ->select('requests.*')
            ->where([
                ['status','=','Accepted'],
                ['requestDate','LIKE',$admin_request->requestDate],
                ['specialEvent','!=',NULL],
            ])
            ->get();

        $nonAvailableHalls_Special[0]='1';

        foreach($specialRequests as $specialRequest)
        {
            $i=1;
            list($startTimeSpecial, $dash, $endTimeSpecial) = explode(" ",$specialRequest->timeSlot);
            $duration=$endTimeSpecial - $startTimeSpecial;

            $startTimeSpecial = (int)$startTimeSpecial;
            $endTimeSpecial = (int)$endTimeSpecial;
            $firsttime = (int)$firsttime;
            $lasttime = (int)$lasttime;

            while($startTimeSpecial<=$endTimeSpecial)
            {

                 if($startTimeSpecial==$firsttime)
                 {
                     $nonAvailableHalls_Special[$i]=$specialRequest->resourceID;
                     $i=$i+1;
                 }
                 if ($startTimeSpecial==$lasttime)
                 {
                     $nonAvailableHalls_Special[$i]=$specialRequest->resourceID;
                     $i=$i+1;
                 }
                 $startTimeSpecial=$startTimeSpecial+1.00;
            }
        }

        $availableHalls_Special=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls_Special)
            ->where('type','LIKE',$admin_request->ResourceType)
            ->orderBy('id', 'desc')
            ->lists('hallNo');

        $sem_form_int = array_intersect($availableHalls_semester, $availableHalls_formal);

        $finalHalls = array_intersect($sem_form_int,$availableHalls_Special);

        return view('adminRequests.admin_request_edit',compact('admin_request','batch','selectedSub','requestedUser','finalHalls'))->with('dateFinal',$dateFinal)->with('finalHalls',$finalHalls);

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
        $admin_request->resourceID=$request['selectResources'];
        $admin_request->status='Accepted';
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
                               is Approved');
        });


        return redirect::route('adminRequestShow');
    }

    /**
     * @param Admin_Request $admin_request <- details of the request
     * @return to the main view
     *
     * This functions takes the details of the request as the parameter, then extracts details
     * such as user email of the user who made the request and then creates the body of the request
     * and send an email to the user's email address notifying there are not available resources
     */
    public function notifyNoResources(Admin_Request $admin_request)
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
        $request_type = array_pluck($user_request,'ResourceType');



        Mail::send([], [], function ($message) use ($user_email,$request_hall,$request_status,$request_date,$request_timeslot,$admin_request) {
            $message->to($user_email)
                ->subject('No Resources Available for the Request')

                ->setBody('Your Request For
                               Type: '.$admin_request->ResourceType.'
                               On: '.$request_date[0].'
                               For:  '.$request_timeslot[0].' Time Slot
                               Has no available resources to be assigned.');
        });


        return redirect::route('adminRequestShow');
    }

    /**
     * End of Formal Request Management Methods
     */

    /**
     * Semester Requests
     */

    public function showSemesterRequests()
    {
        $semesterRequests = \DB::table('semester_requests')
            ->join('subject', 'semester_requests.subjectCode', '=', 'subject.id')
            ->join('batch', 'semester_requests.batchNo', '=', 'batch.id')
            ->join('users','semester_requests.lecturerID','=', 'users.staff_id')
            ->join('allowed_users','semester_requests.lecturerID','=','allowed_users.staff_id')
            ->select('semester_requests.*','subject.subName','batch.batchNo','users.name','allowed_users.position')
            ->where('semester_requests.status','!=','Accepted')
            ->orderBy('allowed_users.position')
            ->orderBy('semester_requests.year')
            ->orderBy('batch.batchNo')
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


    public function loadAvailableResourcesDate()
    {
        $time= Input::get('option2');

        list($firsttime, $dash, $lasttime) = explode(" ",$time);

        $date= Input::get('option');
        $reqResourceType = Input::get('option3');
        $batch = Input::get('option4');

        $batchCap=\DB::table('batch')
            ->where('id','=',$batch)
            ->value('noOfStudents');

        $nonAvailableHalls=\DB::table('semester_requests')
            ->select('resourceID')
            ->where([
                ['status','=','Accepted'],
                ['requestDate','=',$date],
                ['timeSlot','LIKE',$firsttime .'%'],
            ])
            ->orWhere([
                ['status','=','Accepted'],
                ['requestDate','=',$date],
                ['timeSlot','LIKE','%'.$lasttime],
            ])
            //->orWhere('timeSlot','LIKE','%'.$lasttime)
            ->lists('resourceID');

        $availableHalls=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls)
            ->where([
                ['type','LIKE',$reqResourceType],
                //['capacity','>',$batchCap],
            ])
            /*->orWhere([
                ['type','LIKE',$reqResourceType],
                ['capacity','=',$batchCap],
            ])*/

            //->orWhere('capacity','>',$batchCap)
            ->orderBy('id', 'desc')
            ->lists('type','hallNo');

        return Response::json($availableHalls);
    }

    public function loadAvailableResourcesTime()
    {
        $time = Input::get('option');

        list($firsttime, $dash, $lasttime) = explode(" ",$time);
        $date = Input::get('option2');
        $reqResourceType = Input::get('option3');
        $batch = Input::get('option4');

        $batchCap=\DB::table('batch')
            ->where('id','=',$batch)
            ->value('noOfStudents');

        $nonAvailableHalls=\DB::table('semester_requests')
            ->select('resourceID')
            ->where([
                ['status','=','Accepted'],
                ['requestDate','=',$date],
                ['timeSlot','LIKE',$firsttime .'%'],
            ])
            ->orWhere([
                ['status','=','Accepted'],
                ['requestDate','=',$date],
                ['timeSlot','LIKE','%'.$lasttime],
            ])
            //->orWhere('timeSlot','LIKE','%'.$lasttime)
            ->lists('resourceID');

        $availableHalls=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls)
            ->where([
                ['type','LIKE',$reqResourceType],
                //['capacity','>',$batchCap],
            ])
            /*->orWhere([
                ['type','LIKE',$reqResourceType],
                //['capacity','=',$batchCap],
            ])*/

            //->orWhere('capacity','>',$batchCap)
            ->orderBy('id', 'desc')
            ->lists('type','hallNo');


        return Response::json($availableHalls);
    }

    /**
     * Semester Requests End
     */

    /**
     * Special Requests
     */

    /**
     * Show special request interface
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSpecialRequests()
    {
        $specialRequests = \DB::table('requests')
            ->join('users','requests.lecturerID','=', 'users.staff_id')
            ->select('requests.*','users.name','requests.capacity','requests.specialEvent')
            ->where('requests.status','!=','Accepted')
            ->get();
        $acceptedSpecialRequests=\DB::table('requests')
            ->join('users','requests.lecturerID','=', 'users.staff_id')
            ->select('requests.*','users.name','requests.capacity','requests.specialEvent')
            ->where('requests.status','=','Accepted')
            ->get();


        return view('adminRequests.adminSpecialRequestView',compact('specialRequests','acceptedSpecialRequests'));
    }

    /**
     * @param Admin_Request $adminSpecialRequest
     * Special requests edit view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editSpecialRequest(Admin_Request $adminSpecialRequest)
    {
        $requestedUser=DB::table('users')
            ->select('users.id','users.name')
            ->where('staff_id',$adminSpecialRequest->lecturerID)
            ->first();

        return view('adminRequests.adminSpecialRequestEdit',compact('adminSpecialRequest','requestedUser'));
    }

    /**
     * @param Request $request
     * @param Admin_Request $adminSpecialRequest
     * @return updating special requests
     */
    public function updateSpecialRequest(Request $request,Admin_Request $adminSpecialRequest)
    {
        $adminSpecialRequest->requestDate=$request['selectdateEdit'];
        $adminSpecialRequest->timeSlot=$request['selectTimeEdit'];
        $adminSpecialRequest->resourceID=$request['selectResources'];
        $adminSpecialRequest->status='Accepted';

        $adminSpecialRequest->save();

        return redirect::route('adminSpecialRequest');
    }

    /**
     * @return mixed
     */
    public function loadAvailableResourcesDateSpecialRequest()
    {
        $time= Input::get('option2');

        list($firsttime, $dash, $lasttime) = explode(" ",$time);

        $date= Input::get('option');
        $reqResourceType = Input::get('option3');
        $batch = Input::get('option4');

        $batchCap=\DB::table('batch')
            ->select('noOfStudents')
            ->where('id','=',$batch)
            ->first();

        $nonAvailableHalls=\DB::table('semester_requests')
            ->select('resourceID')
            ->where('status','=','Accepted')
            ->where('requestDate','=',$date)
            ->where('timeSlot','LIKE',$firsttime .'%')
            ->orWhere('timeSlot','LIKE','%'.$lasttime)
            ->lists('resourceID');

        $availableHalls=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls)
            ->where('type','LIKE',$reqResourceType)
            //->where('capacity','=',$batchCap)
            //->Where('capacity','>',$batchCap)
            ->orderBy('id', 'desc')
            ->lists('type','hallNo');

        return Response::json($availableHalls);
    }

    public function loadAvailableResourcesTimeSpecialRequest()
    {
        $time = Input::get('option');

        list($firsttime, $dash, $lasttime) = explode(" ",$time);
        $date = Input::get('option2');
        $reqResourceType = Input::get('option3');
        $batch = Input::get('option4');

        $batchCap=\DB::table('batch')
            ->select('noOfStudents')
            ->where('id','=',$batch)
            ->first();

        $nonAvailableHalls=\DB::table('semester_requests')
            ->select('resourceID')
            ->where('status','=','Accepted')
            ->where('requestDate','=',$date)
            ->where('timeSlot','LIKE',$firsttime .'%')
            ->orWhere('timeSlot','LIKE','%'.$lasttime)
            ->lists('resourceID');

        $availableHalls=\DB::table('resource')
            ->whereNotIn('hallNo',$nonAvailableHalls)
            ->where('type','LIKE',$reqResourceType)
            //->where('capacity','=',$batchCap)
            //->Where('capacity','>',$batchCap)
            ->orderBy('id', 'desc')
            ->lists('type','hallNo');


        return Response::json($availableHalls);
    }

    /**
     * Special Requests End
     */

}
