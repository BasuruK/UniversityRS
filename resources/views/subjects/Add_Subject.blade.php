@extends('adminHome')

@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Add a New Subject</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="/subject/Add_Subject">

      <div class="box-body">

        <div class="form-group">
          <label for="subjectCode">Subject Code</label>
          <input type="text" class="form-control" id="subjectCode" name="subjectCode" placeholder="Enter Subject Code..."/>
        </div>

        <div class="form-group">
          <label for="subjectName">Subject Name</label>
          <input type="text" class="form-control" id="subjectName" name="subjectName" placeholder="Enter Subject Name..."/>
        </div>

        <div class="form-group">
          <label for="semester">Semester</label>
          <input type="text" class="form-control" id="semester" name="semester" placeholder="Enter Semester..."/>
        </div>

        <div class="form-group">
          <label for="year">Year</label>
          <input type="text" class="form-control" id="year" name="year" placeholder="Enter Year..."/>

        </div>
        <div class="form-group">
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </div>
      </div>
      <!-- /.box-body -->

      {!! csrf_field() !!}
    </form>
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
      @endforeach
    </div> <!-- end .flash-message -->
  </div>

@stop