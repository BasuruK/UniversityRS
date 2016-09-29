@extends('layouts.main')

@section('content')

    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add a Batch</h3>
            </div>
            <!-- /.box-header -->

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div> <!-- end .flash-message -->

            <!-- form start -->
            <form role="form" method="POST" action="{{ url('/batch/batch_add') }}">
                
              <div class="box-body">
                  
                <div class="form-group">
                  <label for="batchNo">Batch No</label>
                  <input type="text" class="form-control" id="batchNo" name="batchNo" placeholder="Enter Batch Number..."/>
                </div>
                  
                  <div class="form-group">
                  <label for="year">Year</label>
                  <input type="text" class="form-control" id="year" name="year" placeholder="Enter Year..."/>
                  </div>
                  
                  <div class="form-group">
                  <label for="noStudents">No. of Students</label>
                  <input type="text" class="form-control" id="noStudents" name="noStudents" placeholder="Enter Number of Students..."/>
                    </div>
                  
                  <div class="form-group">
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Add Batch</button>
                      <a href="/batch" class="btn btn-primary">Cancel</a>
                  </div>
              </div>
              </div>
              <!-- /.box-body -->

              {!! csrf_field() !!}
            </form>
          </div>

@endsection