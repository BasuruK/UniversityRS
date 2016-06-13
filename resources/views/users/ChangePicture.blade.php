@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            User Profile
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
        <div class="col-md-4 col-md-offset-4">
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
                    <form class="form-horizontal" id="upload" method="POST" enctype="multipart/form-data" action="/upload/image/{{  $user->id  }}">
                        {!! csrf_field() !!}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <div class="col-sm-12">
                            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}" />-->
                                <input type="file" name="image" id="image" />
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