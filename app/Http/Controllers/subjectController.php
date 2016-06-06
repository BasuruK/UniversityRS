<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Http\Requests;
use Redirect;

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
     */
    public function addSubjects(Request $request)
    {
        //return $request->all();
        
//        $this->validate($request,[
//            'subCode'  => 'required',
//            'subName'  => 'required',
//            'semester'  => 'required',
//            'year'  => 'required'
//        ]);
        
        $subject = new Subject();
        
        $subject->subCode = $request['subjectCode'];
        $subject->subName = $request['subjectName'];
        $subject->semester = $request['semester'];
        $subject->year = $request['year'];
        
        $subject->save();
        
        return Redirect::route('Subjectmain'); 
    }

    /**
     * @param Subject $subject
     * @return $this
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
        $subject->update($request->all());
        
        return Redirect::route('Subjectmain'); 
    }

    /**
     * @param Subject $subject
     * @return mixed
     */
    public function delete(Subject $subject)
    {
        Subject::destroy($subject['id']);
        return Redirect::route('Subjectmain'); 
    }
}
