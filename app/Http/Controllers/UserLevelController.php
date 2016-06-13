<?php

namespace App\Http\Controllers;

use App\Allowed_User;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Hash;
use Validator;
use Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class UserLevelController extends Controller
{
    /**
     * Specifies that this Controller can only be accessed if user is Authenticated.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        /**
         * If user is an admin : AdminHome will be returned else UserHome will be returned
         */
        if(!Auth::user()->isAdmin())
        {
            return view('home');
        }
        else
        {
            return view('adminHome');
        }
    }

    /**
     * This method returns all the current authenticated user data to the
     * user profile view
     */
    public function profileView()
    {
        $user = Auth::user();
        return view('users.UserProfile')->with('userData',$user);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requestFormView()
    {
        return view('userRequests.requestForm');
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editProfile(Request $request, User $user)
    {
        $user->name = $request['nameEdit'];
        $user->save();
        return back();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return $this
     */
    public  function  editPassword(Request $request, User $user)
    {
        $rules = array(
            'passwordEditOld' => 'required',
            'passwordEditNew' => 'required',
            'passwordEditConfirm' => 'required|same:passwordEditNew'
        );

        $validator = Validator::make(Input::only('passwordEditOld', 'passwordEditNew', 'passwordEditConfirm'), $rules);

        if($validator->fails())
        {
            return back()->withErrors($validator);
        }
        else
        {
            if (Hash::check($request['passwordEditOld'], $user->getAuthPassword()))
            {
                if ($request['passwordEditNew'] == $request['passwordEditConfirm'])
                {
                    $user->password = Hash::make($request['passwordEditNew']);
                    $user->save();
                    $message = array('msg' => 'Password changed Successfully');
                    return back()
                        ->withErrors($message);
                }
                else
                {
                    $message = array('msg' => 'New password does not match with Confirm password ');
                    return back()
                        ->withErrors($message);
                }
            }
            else
            {
                $message = array('msg' => 'Invalid Old Password');
                return back()
                    ->withErrors($message);
            }
        }
    }

    /**
     * @return $this
     */
    public function UploadPictureForm()
    {
        $user = Auth::user();
        return view('users.ChangePicture')->with('user',$user);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function pictureUpload(Request $request, User $user)
    {
        $this->validate($request, [
            'image' => 'required'
        ]);
        if($request->hasFile('image'))
        {
            $file = Input::file('image');

            $destination = '/public/Pictures/';

// ex: photo-5396e3816cc3d.jpg
            $filename = Str::lower(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                .'.'
                .$file->getClientOriginalExtension()
            );
            $file->move($destination, $filename);
            $user->picture = $filename;
            $user->save();

            return Redirect::route('profile');

        }

    }

}
