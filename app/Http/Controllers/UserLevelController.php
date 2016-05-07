<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        return view('home');
    }
    
    public function profileView($userID)
    {
        $user = User::find($userID);
        return view('users.UserProfile')->with('userData',$user);
    }
}
