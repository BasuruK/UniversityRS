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
    
    
    public function AddRequestForm()
    {
        
        $batches=\DB::table('batch')->get();
        $subjects=\DB::table('subject')->get();
        $resources=\DB::table('resource')->get();
        return view('userRequests.requestForm',compact('batches','subjects','resources','user'));
    }
    public function AddRequest(Request $request)
    {
        //return $request->all();
        
        $this->validate($request, [
            'selectdate'=>'required',   
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
    public function Index()
    {

        //$requests = \DB::table('requests')->where('id', '{{Auth::user()->id}}')->all();
        //$requests = \DB::table('requests')->select('id', '{{Auth::user()->id}}')->get();
      $requests = \DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('batch', 'requests.batchNo', '=', 'batch.id')
            ->join('resource', 'requests.resourceID', '=', 'resource.id')
            ->select('requests.*','subject.subName','resource.hallNo','batch.batchNo')
            ->where('requests.lecturerID', \Auth::user()->staff_id)
            ->get();
        $acceptedrequests=\DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.id')
            ->join('batch', 'requests.batchNo', '=', 'batch.id')
            ->join('resource', 'requests.resourceID', '=', 'resource.id')
            ->select('requests.*','subject.subName','resource.hallNo','batch.batchNo')
            ->where('requests.lecturerID', \Auth::user()->staff_id)
            ->where('requests.status','=','Accepted')
            ->get();
    
        return view('userRequests.viewRequests',compact('requests','acceptedrequests'));
    }

    /**
     * @param userRequest $userRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function EdituserRequestForm(userRequest $userRequest)
    {

        $batches=\DB::table('batch')->get();
        $subjects=\DB::table('subject')->get();
        $resources=\DB::table('resource')->get();
        
        //return $userRequest;
        return view('userRequests.editRequest',compact('userRequest','batches','subjects','resources'));
        
    }
    
     public function updateuserRequest(Request $request,userRequest $userRequest)
    {
          
         $userRequest->year=$request['selectyearEdit'];
         $userRequest->batchNo=$request['selectbatchEdit'];
         $userRequest->subjectCode=$request['selectsubEdit'];
         $userRequest->requestDate=$request['selectdateEdit'];
         $userRequest->timeSlot=$request['selecttimeEdit'];
         $userRequest->resourceID=$request['selectresEdit'];
         $userRequest->save();
         
         return redirect::to('/userRequest/Show/');
    }
    
    public function deleteUserRequest(userRequest $userRequest)
    {
        userRequest::destroy($userRequest['id']);
       return redirect::to('/userRequest/Show/');
        
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

    public function loadAvailabeResources()
    {
        $time= Input::get('option');
        $date= Input::get('option2');
        $availableHalls=\DB::table('resource')
            ->join('requests', 'resource.id', '=', 'requests.resourceID')
            ->where('status','!=','Accepted')
            ->where('requestDate','!=',$date)
            ->where('timeSlot','!=',$time)
            ->orderBy('resource.id', 'desc')
            ->lists('resource.id','hallNo');
        //return $time;

       return Response::json($availableHalls);

    }
    
}
