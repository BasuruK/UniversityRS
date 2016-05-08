<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    
    /**
    * This method returns all the currunt authenticatd user data to the 
    * userprofile view
    */
    public function profileView()
    {
        $user = Auth::user();
        return view('users.UserProfile')->with('userData',$user);
    }
}
