@extends('layouts.main')

@section('content')

    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Batch</h3>
            </div>
            
            <!-- form start -->
            <form role="form" method="POST" action="/batch/update/{{ $batch->id }}">
                
                {{ method_field('PATCH') }}
            <!-- /.box-header -->
              <div class="box-body  col-md-6">
                    <div class="form-group">
                          <label for="batchNo">Batch No</label>
                          <input type="text" class="form-control" id="batchNo" name="batchNo" value="{{ $batch->batchNo }}"/>
                    </div>
                  
                      <div class="form-group">
                          <label for="year">Year</label>
                          <input type="text" class="form-control" id="year" name="year" value="{{ $batch->year }}"/>
                      </div>
                  
                    <div class="form-group">
                      <label for="noStudents">No. of Students</label>
                      <input type="text" class="form-control" id="noStudents" name="noStudents" value="{{ $batch->noOfStudents }}"/>
                    </div>
                
                
                <div class="box-footer">
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                        <a href="/batch" class="btn btn-primary">Cancel</a>
                    </div>
                  </div>
                  </div>
              <!-- /.box-body -->
                
                
                
              {!! csrf_field() !!}
            </form>
          </div>

@endsection