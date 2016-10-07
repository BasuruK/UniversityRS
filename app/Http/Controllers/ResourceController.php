<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Resource;
use App\Http\Requests;
use Redirect;
use Illuminate\Support\Facades\Input;

class ResourceController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * displays the available resources and the form to add a resource
     */
    public function Index()
    {
        $resources = DB::table('resource')->get();
        return view("resources.addResourceForm", compact('resources'));
    }

    /**
     * @param Request $request
     * @return mixed
     * Adds a new resource to the system
     */
    public function AddResource(Request $request)
    {
        $this->validate($request, [
            'hallNo' => 'required|alpha_num|unique:resource',
            'capacity' => 'required|numeric',
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

        return view('resources.editResource', compact('resource'));

    }

    /**
     * @param Request $request
     * @param Resource $resource
     * @return mixed
     * Updates the details of the resource as provided by the user
     */
    public function updateResource(Request $request, Resource $resource)
    {
        if (resource::where('hallNo', '=', $request['hallNoEdit'])->where('hallNo', '!=',$resource->hallNo) ->first())
        {
            //return resource::where('hallNo','=' ,$request['hallNoEdit'])->first();
            $request->session()->flash('alert-warning', 'Resource already exists!');
            return Redirect::back();

        }
        else
        {
            $resource->hallNo = $request['hallNoEdit'];
            $resource->capacity = $request['capacityEdit'];
            $resource->type = $request['selectTypeEdit'];

            $resource->save();
            $request->session()->flash('alert-warning', 'Resource was successfully edited!');
            return redirect::route('Resources');
        }
        
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
