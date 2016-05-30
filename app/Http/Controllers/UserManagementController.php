<?php

namespace App\Http\Controllers;

use App\Allowed_User;
use App\User;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

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
        $RegisteredUser = User::with('allowedUser.priority')->get();
        $PriorityCategories = DB::table('priority')->get();
        $AuthorizedUser = Allowed_User::with('priority')->get();

        return view('administrator.userManagement')->with('RegisteredUser',$RegisteredUser)->with('PriorityCat',$PriorityCategories)->with('AuthorizedUser',$AuthorizedUser);
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
            'inputPosition'  => 'required'
        ]);
        
        $user           = new Allowed_User();
        $user->staff_id = $request['staff_id'];
        $user->position = $request['inputPosition'];
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


    /**
     * @param User $staff_id
     * @return mixed
     *
     * redirects the user to User Edit Page
     */
    public function EditPageRedirect(User $staff_id)
    {
        $userFromStaffId = $staff_id;
        $PriorityCat = $PriorityCategories = DB::table('priority')->get();
        
        $PriorityLevel = DB::table('allowed_users')
            ->join('priority','priority.id', '=', 'allowed_users.position')
            ->where('allowed_users.staff_id',$staff_id->staff_id)
            ->value('priority.id');

        return view('administrator.UserManagementEdit')->with('userData', $userFromStaffId)->with('PriorityCat',$PriorityCat)->with('PriorityLevel',$PriorityLevel);
    }

    /**
     * @param Request $request
     * @param User $staff_id
     *
     * Updates the user
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditUserUpdate(Request $request,User $staff_id)
    {
        /**
         * Validation for the User Add form
         */
        $this->validate($request,[
            'staff_id'  => 'required|exists:allowed_users',
            'name'  => 'required',
            'email' => 'required',
            'inputPosition' => 'required'
        ]);

        /**
         * Update the user table and also allowed_users table
         */
        $staff_id->update([
            'name' => $request['name'],
            'staff_id' => $request['staff_id'],
            'email' => $request['email']
        ]);

        DB::table('allowed_users')
            ->where('staff_id',$request['staff_id'])
            ->update(['position' => $request['inputPosition']]);


       return redirect()->action('UserManagementController@UserManagement');
    }
}