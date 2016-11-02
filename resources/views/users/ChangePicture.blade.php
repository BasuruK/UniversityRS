@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
           Change Picture
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="">Userprofile</li>
            <li class="active">Change Picture</li>

        </ol>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Upload a Profile Picture</h4>
                </div>
                <div class="box-body box-profile">
                    <div class="span5">
                        <div id="output" style="display:none"></div>
                    </div>
                    <div id="validation-errors"></div>
                    <form class="form-horizontal" id="upload" method="POST" enctype="multipart/form-data" action="/upload/image/{{  $user->id  }}">
                        {!! csrf_field() !!}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input class="form-control" type="file" name="picture" id="picture" required/>
                                <br>
                                <button class="btn btn-primary pull-right"> Upload Picture </button>
                                <a href="/profile" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection