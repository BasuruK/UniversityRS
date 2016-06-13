<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\Http\Requests;
use Redirect;

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
        $batches = \DB::table('batch')->get();
        return view("batches.batch_main",compact('batches'));
    }

    /**
     * @return to a new form
     *
     * This functions returns the user a new form in which details can be filled out
     */
    public function add()
    {
        return view("batches.batch_add");
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
        $batch->batchNo = $request['batchNo'];
        $batch->year = $request['year'];
        $batch->noOfStudents = $request['noStudents'];

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
    public function delete(Batch $batch)
    {
        Batch::destroy($batch['id']);
        return Redirect::route('batchShow');
    }
    
}
