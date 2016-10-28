@extends('layouts.main')

@section('section-header')
    <section class="content-header">
        <h1>
            Batch Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="">Batch Management</li>
            <li class="active">Edit Batch</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="container">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Batch</h3>
                </div>

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

                <div class="box-body">
                    <!-- form start -->
                    <form role="form" method="POST" action="/batch/update/{{ $batch->id }}">
                    {{ method_field('PATCH') }}
                    <!-- /.box-header -->
                        <div class="form-group">
                            <label for="batchNo">Batch No</label>
                            <p>{{ $batch->batchNo }}</p>
                        </div>

                        <div class="form-group">
                            <label for="year">Year</label>
                            <p>{{ $batch->year }}</p>
                        </div>

                        <div class="form-group">
                            <label for="noStudents">No. of Students</label>
                            <input type="text" class="form-control" id="noStudents" name="noStudents" value="{{ $batch->noOfStudents }}"/>
                        </div>

                        <div class="form-group">
                            <label for="selectType">Type</label>
                            <select class="form-control" name="selectType" id="selectType">
                                @if($batch->type=="weekday")
                                    <option value="weekday" selected="selected">Weekday</option>
                                    <option value="weekend">Weekend</option>
                                @elseif ($batch->type=="weekend")
                                    <option value="weekday">Weekday</option>
                                    <option value="weekend" selected="selected">Weekend</option>
                                @endif
                            </select>

                        </div>

                        <div class="box-footer">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                                <a href="/batch" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection