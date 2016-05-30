<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\Http\Requests;
use Redirect;

class BatchController extends Controller
{
    public function show()
    {
        $batches = \DB::table('batch')->get();
        return view("batches.batch_main",compact('batches'));
    }
    
    public function add()
    {
        return view("batches.batch_add");
    }
    
    public function addBatch(Request $request)
    {
        
        $this->validate($request,[
            'batchNo'  => 'required',
            'year'  => 'required',
            'noStudents'  => 'required'
        ]);
        
        $batch = new Batch();
        
        $batch->batchNo = $request['batchNo'];
        $batch->year = $request['year'];
        $batch->noOfStudents = $request['noStudents'];
        
        $batch->save();
        
        return Redirect::route('batchShow');
    }
    
    public function edit(Batch $batch)
    {
        //return $batch;
        return view('batches.batch_edit',compact('batch'));
    }
    
    public function update(Request $request, Batch $batch)
    {
        //$batch->update($request->all());
        $batch->batchNo = $request['batchNo'];
        $batch->year = $request['year'];
        $batch->noOfStudents = $request['noStudents'];

        $batch->save();
        
        return Redirect::route('batchShow');
    }
    
    public function delete(Batch $batch)
    {
        Batch::destroy($batch['id']);
        return Redirect::route('batchShow');
    }
    
}
