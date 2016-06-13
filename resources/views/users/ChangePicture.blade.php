@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Userprofile</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-primary">
        <div class="box-body box-profile">
            <div class="span5">
                <div id="output" style="display:none">
                </div>
            </div>
            <div class="span8">
                <h4>Upload Picture</h4>
            </div>
            <div id="validation-errors"></div>
            <form class="form-horizontal" id="upload" method="POST" action="/upload/image/{{  $user->id  }}">
                {!! csrf_field() !!}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <div class="col-sm-10 ">
                       <!--<input type="hidden" name="_token" value="{{ csrf_token() }}" />-->
                        <input type="file" name="image" id="image" />
                        <button class="btn btn-primary pull-right"> Import File </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection