<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class subjectController extends Controller
{
    public function show()
    {
        $subjects = \DB::table('subject')->get();
        return view('subject_main.blade.php',compact('subjects'));
    } 
    
    public function add()
    {
        return view('Add_Subject.blade.php');
    }
    
    public function addSubjects(Request $request)
    {
        $subject = new Subject;
        
        $subject->subCode = $request->subjectCode;
        $subject->subName = $request->subjectName;
        $subject->semester = $request->semester;
        $subject->year = $request->year;
        
        $subject->save();
        
        return Redirect::route('/subject/'); 
    }
}
