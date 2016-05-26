@extends('layouts')

@section('content')

    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add a New Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="/subject/Add_Subject">
                {{ csrf_field() }}
              <div class="box-body">
                  
                <div class="form-group">
                  <label for="subjectCode">Subject Code</label>
                  <input type="text" class="form-control" id="subjectCode" placeholder="Enter Subject Code...">
                </div>
                  
                  <div class="form-group">
                  <label for="subjectName">Subject Name</label>
                  <input type="text" class="form-control" id="subjectName" placeholder="Enter Subject Name...">
                  </div>
                  
                  <div class="form-group">
                  <label for="semester">Semester</label>
                  <input type="text" class="form-control" id="semester" placeholder="Enter Semester...">
                    </div>
                  
                  <div class="form-group">
                  <label for="year">Year</label>
                  <input type="text" class="form-control" id="year" placeholder="Enter Year...">
                      
                  </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </form>
          </div>

@stop