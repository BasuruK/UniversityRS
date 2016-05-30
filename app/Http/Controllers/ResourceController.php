<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Resource;
use App\Http\Requests;
use Redirect;

class ResourceController extends Controller
{
 
       public function Index()
    {
        $resources = \DB::table('resource')->get();
        return view("resources.addResourceForm",compact('resources'));
    }
    
    public function AddResource(Request $request)
    {
        $this->validate($request,[
            'hallNo'  => 'required',
            'capacity'  => 'required',
        ]);
        
        $resource = new Resource();
        
        $resource->hallNo = $request['hallNo'];
        $resource->type = $request['selectType'];
        $resource->capacity = $request['capacity'];
       
        
        $resource->save();
        
        return back();
    }
    
    public function EditResourceForm(Resource $resource)
    {
        //return $resource;
        return view('resources.editResource',compact('resource'));  
        
    }
    
     public function updateResource(Request $request,Resource $resource)
    {
          
        $resource->hallNo=$request['hallNoEdit'];
         $resource->capacity=$request['capacityEdit'];
         $resource->type=$request['selectTypeEdit'];
         
         $resource->save();
         
         return redirect::to('resource/show');
    }
    
    public function deleteResource(Resource $resource)
    {
        Resource::destroy($resource['id']);
        return redirect::to('resource/show');
        
    }
    
}
