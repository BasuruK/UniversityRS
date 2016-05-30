@extends('layouts.Main')

@section('content')

    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="/subject/Edit_Subject/{{ $subject->id }}">
                {!! csrf_field() !!} 
                {{ method_field('PATCH') }}
                
              <div class="box-body">
                  
                <div class="form-group">
                  <label for="subjectCode">Subject Code</label>
                  <input type="text" class="form-control" id="subjectCode" name="subjectCode" value="{{ $subject->subCode }}"/>
                </div>
                  
                  <div class="form-group">
                  <label for="subjectName">Subject Name</label>
                  <input type="text" class="form-control" id="subjectName" name="subjectName" value="{{ $subject->subName }}"/>
                  </div>
                  
                  <div class="form-group">
                  <label for="semester">Semester</label>
                  <input type="text" class="form-control" id="semester" name="semester" value="{{ $subject->semester }}"/>
                    </div>
                  
                  <div class="form-group">
                  <label for="year">Year</label>
                  <input type="text" class="form-control" id="year" name="year" value="{{ $subject->year }}"/>
                      
                  </div>
                  <div class="form-group">
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                  </div>
              </div>
              </div>
              <!-- /.box-body -->

            </form>
          </div>

@stop