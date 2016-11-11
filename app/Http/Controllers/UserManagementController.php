<?php

namespace App\Http\Controllers;

use App\Allowed_User;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
     * @return \Illuminate\View\View
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
     * Adds a User database record to the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function AddUser(Request $request)
    {
       /**
       * Validation for the User Add form
       */
        $this->validate($request,[
            'staff_id'       => 'required|unique:allowed_users|min:10|max:10|alpha_num',
            'inputPosition'  => 'required'
        ]);
        
        $user           = new Allowed_User();
        $user->staff_id = $request['staff_id'];
        $user->position = $request['inputPosition'];
        $user->save();

        Session::flash('success','Entry added successfully.');
        return back();
    }

    /**
     * Deletes the user
     * @param User $staff_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     *
     */
    public function DeleteUser(User $staff_id)
    {
        $staff_id->delete();
        return back();
    }


    /**
     * redirects the user to User Edit Page
     *
     * @param User $staff_id
     * @return mixed
     *
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
     * Updates the user
     *
     * @param Request $request
     * @param User $staff_id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditUserUpdate(Request $request,User $staff_id)
    {
        /**
         * Validation for the User Add form
         */
        $this->validate($request,[
            'staff_id'  => 'required|exists:allowed_users|max:10|min:10',
            'name'  => 'required',
            'email' => 'required',
            'inputPosition' => 'required'
        ]);

        $adminStatus = 1;

        /**
         * if an Administrator revoke admin privileges then change the admin status to 0 in users table 
         */
        if($request['inputPosition'] != 1)
        {
            $adminStatus = 0;
        }
        /**
         * Update the user table and also allowed_users table
         */
        $staff_id->update([
            'name' => $request['name'],
            'staff_id' => $request['staff_id'],
            'email' => $request['email'],
            'admin' => $adminStatus
        ]);

        DB::table('allowed_users')
            ->where('staff_id',$request['staff_id'])
            ->update(['position' => $request['inputPosition']]);


       return redirect()->action('UserManagementController@UserManagement');
    }

    /**
     * @param Allowed_User $staff_id
     * @return mixed
     *
     * redirects the user to authorized user edit page
     */
    public function EditAuthorizedUserRedirect(Allowed_User $staff_id)
    {
        $PriorityCat = DB::table('priority')->get();

        $PriorityLevel = DB::table('allowed_users')
            ->join('priority','priority.id', '=', 'allowed_users.position')
            ->where('allowed_users.staff_id',$staff_id->staff_id)
            ->value('priority.id');

        return view('administrator.UserManagementAllowedEdit')->with('userData',$staff_id)->with('PriorityCat',$PriorityCat)->with('PriorityLevel',$PriorityLevel);
    }


    /**
     * @param Request $request
     * @param Allowed_User $staff_id
     *
     * Edits the Authorized user
     * @return $this
     */
    public function EditAuthorizedUserUpdate(Request $request,Allowed_User $staff_id)
    { 
        /**
         * Validation for the User Edit form
         */
        $this->validate($request,[
            'staff_id'  => 'required|max:10|min:10|alpha_num',
            'inputPosition' => 'required'
        ]);

        /**
         * Check if the entry user enters exists on the table apart from the actual value, prevent user from updating and creating a duplicate entry.
         */
        $userStaffID    = $staff_id->staff_id;
        $newStaffID     = $request->staff_id;

        $status = DB::table('allowed_users')->where('staff_id','=',$newStaffID)->where('staff_id','!=',$userStaffID)->count();

        if($status > 0)
        {
            //Duplicate entry
            return back()->withErrors(['Duplicate Entry','The Staff_id is already taken by another person.']);
        }


        $adminStatus = 1;

        /**
         * If the authorized user is also an registered user and if authorized users staff_id changed then change the staff_id of registered user also
         */

        $oldAuthorizedUser = $staff_id;
        //the user ID changed
        if($request->staff_id != $oldAuthorizedUser->staff_id)
        {
            DB::table('users')
                ->where('staff_id','=',$staff_id->staff_id)
                ->update(['staff_id' => $request->staff_id]);
        }

        /**
         * if an Administrator revoke admin privileges then change the admin status to 0 in users table
         */
        if($request['inputPosition'] != 1)
        {
            $adminStatus = 0;
        }

        /**
         * Update allowed_users table
         */
        $staff_id->update([
            'staff_id' => $request['staff_id'],
            'position' => $request['inputPosition']
        ]);




        /**
         * update the users table if the user is an already registered user
         */
        $User = DB::table('users')->where('staff_id','=',$request['staff_id'])->first();
        if(!is_null($User)) {
            DB::table('users')
                ->where('staff_id', '=', $request['staff_id'])
                ->update(['admin' => $adminStatus]);
        }
        return redirect()->action('UserManagementController@UserManagement');
    }

    /**
     * @param Allowed_User $staff_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     *
     * Delete the Authorized user, if the authorized user is a registered user then the details regarding that will be deleted
     */
    public function DeleteAuthorizedUser(Allowed_User $staff_id)
    {
        $staff_id->user()->delete();
        $staff_id->delete();
        return back();
    }
}
