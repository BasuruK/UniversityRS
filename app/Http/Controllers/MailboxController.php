<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use DB;
use App\Messages;
use Illuminate\Support\Facades\Redirect;

class MailboxController extends Controller
{
    /**
     * Displayes the page
     * @return $this
     */
    public function index()
    {
        $User = User::select('name','id')->get()->pluck('name'); //send only the names for the autocomplete function
        return view('email.emailPage')->with('User',$User);
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'To' => 'required',
            'Subject' => 'required',
            'Message' => 'required'
        ]);

        $message = new Messages();
        $message->user_id = 2;
        $message->subject = $request['Subject'];
        $message->message = $request['Message'];

        return back();

    }
}
