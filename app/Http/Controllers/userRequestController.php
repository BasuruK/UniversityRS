<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Http\Requests;
use App\userRequest;
use Redirect;
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
        $userRequest->timeSlot=$request['selectdate'];
        $userRequest->resourceID=$request['selectres'];
        
        
        $userRequest->save();
        
        return back(); 
    }
    public function Index()
    {
        //$requests = \DB::table('requests')->where('id', '{{Auth::user()->id}}')->all();
        //$requests = \DB::table('requests')->select('id', '{{Auth::user()->id}}')->get();
      $requests = \DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.subCode')
            ->join('resource', 'requests.resourceID', '=', 'resource.id')
            ->select('requests.*','subject.subName','resource.hallNo')
            ->where('requests.lecturerID', \Auth::user()->staff_id)
            ->get();
        return view('userRequests.viewRequests',compact('requests','subjects'));
    }
    
      public function EdituserRequestForm(userRequest $userRequest)
    {
       //return $userRequest;
        $batches=\DB::table('batch')->get();
        $subjects=\DB::table('subject')->get();
        $resources=\DB::table('resource')->get();
        $selectedSubName=\DB::table('requests')
            ->join('subject', 'requests.subjectCode', '=', 'subject.subCode')
            ->select('subject.subName')
            ->where('requests.id',$userRequest->id)
            ->first();
        $selectedHall=\DB::table('requests')
            ->join('resource', 'requests.resourceID', '=', 'resource.id')
            ->select('resource.hallNo')
            ->where('requests.id',$userRequest->id)
            ->first();
        return view('userRequests.editRequest',compact('userRequest','batches','subjects','resources','selectedSubName','selectedHall'));  
        
    }
    
     public function updateuserRequest(Request $request,userRequest $userRequest)
    {
          
         $userRequest->year=$request['selectyearEdit'];
         $userRequest->batchNo=$request['selectbatchEdit'];
         $userRequest->subjectCode=$request['selectsubEdit'];
         $userRequest->timeSlot=$request['selectdateEdit'];
         $userRequest->resourceID=$request['selectresEdit'];
         $userRequest->save();
         
         return redirect::to('/userRequest/Show/');
    }
    
    public function deleteUserRequest(userRequest $userRequest)
    {
        userRequest::destroy($userRequest['id']);
       return redirect::to('/userRequest/Show/');
        
    }
    
}
