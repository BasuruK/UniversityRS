@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Time Table Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Timetable</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
    <div class="col-md-4">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Import Time Table <small>*Upload Excel sheets</small></h3>
            </div>

            <form action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    {!! csrf_field() !!}
                    <input type="file" name="import_file" />
                    <br/>
                    <div class="box-footer">
                        <button class="btn btn-primary pull-right"> Import File </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection