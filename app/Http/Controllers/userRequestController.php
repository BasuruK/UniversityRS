<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Http\Requests;
use App\userRequest;
use Redirect;
use Illuminate\Support\Facades\Input;
use Response;
class userRequestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *  Redirects user to the form to add a request
     */
    public function AddRequestForm()
    {
        
        $batches=\DB::table('batch')->get();
        $subjects=\DB::table('subject')->get();
        $resources=\DB::table('resource')->get();
        return view('userRequests.requestForm',compact('batches','subjects','resources','user'));
    }

    public function AddRequestFormSemester()
    {

        $batches=\DB::table('batch')->get();
        $subjects=\DB::table('subject')->get();
        $resources=\DB::table('resource')->get();
        return view('userRequests.semesterRequestForm',compact('batches','subjects','resources','user'));
    }


    /**
     * @param Request $request
     * @return mixed
     *  Adds a user request to the system
     */
    public function AddRequest(Request $request)
    {
        
        $this->validate($request, [
            'selectdate'=>'required',
            'selectyear'=>'required',
            'selectbatch'=>'required',
            'selecttime'=>'required',
            'selectres'=>'required',
        ]);
        
        $userRequest= new userRequest();
        
       
        $userRequest->lecturerID=$request['staffID'];
        $userRequest->year=$request['selectyear'];
        $userRequest->batchNo=$request['selectbatch'];
        $userRequest->subjectCode=$request['selectsub'];
        $userRequest->requestDate=$request['selectdate'];
        $userRequest->resourceID=$request['selectres'];
        $userRequest->timeSlot=$request['selecttime'];
        
        
        $userRequest->save();


        return redirect::to('/userRequest/Show/');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Display details of current requests placed by the user and the accepted requests
     */
    public function Index()
    {

      $requests = \DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('batch', 'requests.batchNo', '=', 'batch.id')
            ->select('requests.*','subject.subName','batch.batchNo')
            ->where('requests.lecturerID', \Auth::user()->staff_id)
            ->where('requests.status','!=','Accepted')
            ->get();
        $acceptedrequests=\DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('batch', 'requests.batchNo', '=', 'batch.id')
            ->select('requests.*','subject.subName','batch.batchNo')
            ->where('requests.lecturerID', \Auth::user()->staff_id)
            ->where('requests.status','=','Accepted')
            ->get();
    
        return view('userRequests.viewRequests',compact('requests','acceptedrequests'));
    }


    /**
     * @param userRequest $userRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Redirects user to the edit user request form
     */
    public function EdituserRequestForm(userRequest $userRequest)
    {

        $batches=\DB::table('batch')->get();
        $subjects=\DB::table('subject')->get();
        $resources=\DB::table('resource')->get();

        $selectedSub=\DB::table('subject')
            ->where('id',$userRequest->subjectCode)
            ->first();

        return view('userRequests.editRequest',compact('userRequest','batches','subjects','resources','selectedSub'));
        
    }

    /**
     * @param Request $request
     * @param userRequest $userRequest
     * @return mixed
     * Update the placed user request
     */
     public function updateuserRequest(Request $request,userRequest $userRequest)
    {

        $this->validate($request, [
            'selectdateEdit'=>'required',
            'selectyearEdit'=>'required',
            'selectbatchEdit'=>'required',
            'selecttimeEdit'=>'required',
            'selectresEdit'=>'required',
        ]);
         $userRequest->year=$request['selectyearEdit'];
         $userRequest->batchNo=$request['selectbatchEdit'];
         $userRequest->subjectCode=$request['selectsubEdit'];
         $userRequest->requestDate=$request['selectdateEdit'];
         $userRequest->timeSlot=$request['selecttimeEdit'];
         $userRequest->resourceID=$request['selectresEdit'];
         $userRequest->save();
         
         return redirect::to('/userRequest/Show/');
    }

    /**
     * @param userRequest $userRequest
     * @return mixed
     * delete the user request from the system
     */
    public function deleteUserRequest(userRequest $userRequest)
    {
        userRequest::destroy($userRequest['id']);
       return redirect::to('/userRequest/Show/');
        
    }

    /**
     * @return the set of selected batches
     * populates the batches select option according to the year selected
     */
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


    /**
     * @return an array of available resources
     * populate the resources selet option with the available resources on the date selected
     */
    public function loadAvailabeResourcesDate()
    {
        $time= Input::get('option2');
        $date= Input::get('option');
        $nonavailableHalls=DB::table('resource')
            ->join('requests', 'resource.hallNo', '=', 'requests.resourceID')
            ->select('resource.hallNo')
            ->where('status','=','Accepted')
            ->where('requestDate','=',$date)
            ->where('timeSlot','=',$time)
            ->lists('hallNo');

        $availableHalls=DB::table('resource')
            ->whereNotIn('hallNo',$nonavailableHalls)
            ->orderBy('id', 'desc')
            ->lists('type','hallNo');


        return Response::json($availableHalls);

    }

    /**
     * @return an array of available resources
     * populate the resources selet option with the available resources on the date selected and the time selected
     */
    public function loadAvailabeResourcesTime()
    {
        $time= Input::get('option');
        $date= Input::get('option2');
        $nonavailableHalls=DB::table('resource')
            ->join('requests', 'resource.hallNo', '=', 'requests.resourceID')
            ->select('resource.hallNo')
            ->where('status','=','Accepted')
            ->where('requestDate','=',$date)
            ->where('timeSlot','=',$time)
            ->lists('hallNo');

        $availableHalls=DB::table('resource')
            ->whereNotIn('hallNo',$nonavailableHalls)
            ->orderBy('id', 'desc')
            ->lists('type','hallNo');


        return Response::json($availableHalls);

    }

    
    
}
