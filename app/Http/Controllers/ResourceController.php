<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Resource;
use App\Http\Requests;
use Redirect;

class ResourceController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * displays the available resources and the form to add a resource
     */
    public function Index()
    {
        $resources = DB::table('resource')->get();
        return view("resources.addResourceForm",compact('resources'));
    }

    /**
     * @param Request $request
     * @return mixed
     * Adds a new resource to the system
     */
    public function AddResource(Request $request)
    {
        $this->validate($request,[
            'hallNo'  => 'required',
            'capacity'  => 'required|numeric',
        ]);
        
        $resource = new Resource();
        
        $resource->hallNo = $request['hallNo'];
        $resource->type = $request['selectType'];
        $resource->capacity = $request['capacity'];
       
        
        $resource->save();

        return redirect::to('resource/show');
    }

    /**
     * @param Resource $resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * redirects the user to a form to edit current resource details
     */
    public function EditResourceForm(Resource $resource)
    {
       
        return view('resources.editResource',compact('resource'));  
        
    }

    /**
     * @param Request $request
     * @param Resource $resource
     * @return mixed
     * Updates the details of the resource as provided by the user
     */
     public function updateResource(Request $request, Resource $resource)
    {
//return $resource;
        $this->validate($request,[
            'hallNo'  => 'required|alpha_num',
            'capacity'  => 'required|numeric'
        ]);

        $resource->hallNo=$request['hallNoEdit'];
        $resource->capacity=$request['capacityEdit'];
        $resource->type=$request['selectTypeEdit'];

        $resource->save();
         
         return redirect::to('resource/show');
    }

    /**
     * @param Resource $resource
     * @return mixed
     * deletes a resource from the system
     */
    public function deleteResource(Resource $resource)
    {
        Resource::destroy($resource['id']);
        return redirect::to('resource/show');
        
    }
    
}
