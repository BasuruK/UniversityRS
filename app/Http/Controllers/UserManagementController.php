<?php

namespace App\Http\Controllers;

use App\Allowed_User;
use App\User;
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
     * @return $this
     *
     * Returns the view user management compacted with user object
     */
    public function UserManagement()
    {
        $RegisteredUser = User::with('allowedUser')->get();
        return view('administrator.userManagement')->with('RegisteredUser',$RegisteredUser);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Adds a User database record to the database
     */
    public function AddUser(Request $request)
    {
       /**
       * Validation for the User Add form
       */
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

    /**
     * @param User $staff_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     *
     * Deletes the user
     */
    public function DeleteUser(User $staff_id)
    {
        $staff_id->delete();
        return back();
    }
}
