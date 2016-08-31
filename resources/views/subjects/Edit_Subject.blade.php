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
                      <label for="year">Year</label>
                      <select class="form-control" name="selectyear" id="selectyear">
                          <option value="{{ $subject->id }}">{{ $subject->year }}</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                      </select>
                  <!-- <input type="text" class="form-control" id="year" name="year" value="{{ $subject->year }}"/>-->

                  </div>
                  
                  <div class="form-group">
                  <label for="semester">Semester</label>
                      <select class="form-control" name="selectsemester" id="selectsemester">
                          <option value="{{ $subject->id }}">{{ $subject->semester }}</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                      </select>
                  <!--<input type="text" class="form-control" id="semester" name="semester" value="{{ $subject->semester }}"/>-->
                    </div>

                  <div class="form-group">
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                      <a href="/subject" class="btn btn-primary">Cancel</a>
                  </div>
              </div>
              </div>
              <!-- /.box-body -->

            </form>
          </div>

@stop