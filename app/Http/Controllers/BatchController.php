<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\Http\Requests;
use Redirect;
use DB;
use Session;

class BatchController extends Controller
{
    /**
     * @return to the main page of the Batch Management
     *
     * This functions pass the main page and the collection of details regarding the batches
     * through a view
     */
    public function show()
    {
        $batches = \DB::table('batch')
            ->orderBy('year')
            ->orderBy('batchNo')
            ->get();
        return view("batches.batch_main",compact('batches'));
    }

    /**
     * @param Request $request <- details from the new form
     * @return to the main page
     *
     * This functions takes the details from the new form as a parameter, and then creates an Batch object
     * to which the values are assigned and saved as a record in the database
     */
    public function addBatch(Request $request)
    {

        $this->validate($request,[
            'batchNo'       => 'bail|required',
            'year'          => 'bail|numeric|required',
            'noStudents'    => 'numeric|required'
        ]);

        if (DB::table('batch')->where('year', $request['year'])->where('batchNo',$request['batchNo'])->where('type',$request['selectType'])->first())
        {
            $request->session()->flash('alert-warning', 'Batch already exists!');
            return Redirect::back();
        }
        else
        {
            $batch = new Batch();

            $batch->batchNo         = $request['batchNo'];
            $batch->year            = $request['year'];
            $batch->noOfStudents    = $request['noStudents'];
            $batch->type            =$request['selectType'];

            $batch->save();

            return Redirect::route('batchShow');
        }
    }

    /**
     * @param Batch $batch <- details of the batch to be edited
     * @return to the edit form
     *
     * This function takes the details of the batch to be edited as a parameter and pass
     * them to the edit form, and the details are displayed in the edit form accordingly
     */
    public function edit(Batch $batch)
    {
        //return $batch;
        return view('batches.batch_edit',compact('batch'));
    }

    /**
     * @param Request $request <- modified details from the edit form
     * @param Batch $batch <- original details of the batch
     * @return to the main page
     *
     * This functions takes the modified details and the original details of the batch as
     * parameters and then assign the new values to the batch object. Then it updates the relevant
     * record in the database
     */
    public function update(Request $request, Batch $batch)
    {
        //$batch->update($request->all());
        $this->validate($request,[
            /*'batchNo'       => 'bail|numeric|required',
            'year'          => 'bail|numeric|required',*/
            'noStudents'    => 'bail|numeric|required'
        ]);

        //$batch->batchNo         = $request['batchNo'];
        //$batch->year            = $request['year'];
        $batch->noOfStudents    = $request['noStudents'];
        $batch->type            = $request['selectType'];

        $batch->save();

        return Redirect::route('batchShow');
    }

    /**
     * @param Batch $batch <- details of the batch to be deleted
     * @return to the main page
     *
     * This function takes the batch to be deleted and carries out the destroy function which deletes
     * the relevant record from the database
     */
    public function delete(Request $request, Batch $batch)
    {
        $batchSR = \DB::table('semester_requests')
            ->where('batchNo','=',$batch['id'])
            ->first();

        $batchFASER = \DB::table('requests')
            ->where('batchNo','=',$batch['id'])
            ->first();

        if($batchSR==NULL && $batchFASER==NULL)
        {
            Batch::destroy($batch['id']);
            return Redirect::route('batchShow');
        }
        else
        {
            $request->session()->flash('alert-danger', 'Batch is being used!');
            return Redirect::back();
        }
    }
    
}
