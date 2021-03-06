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
<div class="container-fulid">
    <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../dist/img/{{ $userData->picture }}" alt="User profile picture">
              <h3 class="profile-username text-center">{{ $userData->name }}</h3>
              <p class="text-muted text-center">
                  @if($userData->admin == 1)
                    Administrator
                  @else
                    Lecturer
                  @endif
                </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Subjects Tought</b> <a class="pull-right">5</a>
                </li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
        
        <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
                  <li class=""><a href="#password" data-toggle="tab" aria-expanded="false">Password</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name" value="{{ $userData->name }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10 ">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ $userData->email }}" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                    
                  <div class="tab-pane" id="password">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputEmail" placeholder="Confirm Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div>
    </div>
</div>
@endsection