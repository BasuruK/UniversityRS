<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Http\Requests;
use Redirect;
use Validator;
use DB;
use Illuminate\Support\Facades\Input;

class subjectController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $subjects = \DB::table('subject')->get();
        return view("subjects.subject_main",compact('subjects'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('subjects.Add_Subject');
    }

    /**
     * @param Request $request
     * @return mixed
     * Add subjects to the system by providing subject details
     */
    public function addSubjects(Request $request)
    {
        $rules = array(
            'subjectCode' => 'required',
            'subjectName' => 'required',
            'selectsemester' => 'required|numeric',
            'selectyear' => 'required|numeric'
        );

        $validator = Validator::make(Input::only('subjectCode', 'subjectName', 'selectsemester', 'selectyear'), $rules);

        if (DB::table('subject')->where('subCode', $request['subjectCode'])->orwhere('subName',$request['subjectName'])->first())
        {
            $request->session()->flash('alert-warning', 'Subject already exists!');
            return Redirect::back();
        }
        else if($validator->fails())
        {
            $request->session()->flash('alert-danger', 'Cannot have empty fields!!');
            return back()->withErrors($validator);
        }
        else
        {

            $subject = new Subject();

            $subject->subCode = $request['subjectCode'];
            $subject->subName = $request['subjectName'];
            $subject->semester = $request['selectsemester'];
            $subject->year = $request['selectyear'];

            $subject->save();

            $request->session()->flash('alert-success', 'Subject was successful added!');
            return Redirect::route('Subjectmain');
        }
    }

    /**
     * @param Subject $subject
     * @return $this
     * edit subject view
     */
    public function edit(Subject $subject)
    {
        return view('subjects.Edit_Subject')->with('subject',$subject);
    }

    /**
     * @param Request $request
     * @param Subject $subject
     * @return mixed
     */
    public function editSubjects(Request $request, Subject $subject)
    {
        $rules = array(
            'subjectCode' => 'required',
            'subjectName' => 'required',
            'selectsemester' => 'required|numeric',
            'selectyear' => 'required|numeric'
        );

        $validator = Validator::make(Input::only('subjectCode', 'subjectName', 'selectsemester', 'selectyear'), $rules);

        if (DB::table('subject')->where('subCode', $request['subjectCode'])->orwhere('subName',$request['subjectName'])->first())
        {
            $request->session()->flash('alert-warning', 'Subject already exists!');
            return Redirect::back();
        }
        else if($validator->fails())
        {
            $request->session()->flash('alert-danger', 'Cannot have empty fields!!');
            return back()->withErrors($validator);
        }
        else
        {
            $subject->subCode = $request['subjectCode'];
            $subject->subName = $request['subjectName'];
            $subject->semester = $request['selectsemester'];
            $subject->year = $request['selectyear'];

            $subject->save();

            $request->session()->flash('alert-success', 'Subject was successful updated!');
            return Redirect::route('Subjectmain');
        }
    }

    /**
     * @param Subject $subject
     * @return mixed
     */
    public function delete(Subject $subject, Request $request)
    {
        if(\DB::table('requests')->where('subjectCode','=',$subject['subCode'])->where('status','=','Accepted')->first()||\DB::table('semester_requests')->where('subjectCode','=',$subject['subCode'])->where('status','=','Accepted')->first())
        {
            $request->session()->flash('alert-danger', 'Subject is already being used!');
            return Redirect::back();
        }
        else
        {
            Subject::destroy($subject['id']);
            return Redirect::route('Subjectmain');
        }
    }
}
