<?php

namespace App\Http\Controllers;

use App\Allowed_User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    /**
    * Add a new Allowed_User to the Database
    */
    public function AddUser(Request $request)
    {
       
        $this->validate($request,[
            'staff_id'  => 'required|unique:allowed_users',
            'position'  => 'required'  
        ]);
        
        $user           = new Allowed_User();
        $user->staff_id = $request['staff_id'];
        $user->position = $request['position'];
        $user->save();
        
        return back();
    }
}
