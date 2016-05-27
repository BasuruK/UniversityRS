@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>User Management <small>Edit User</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>User Management</li>
            <li class="active">Edit User</li>
        </ol>
    </section>
@endsection

@section('content')

    <!--Box 1-->
    <div class="col-md-6 col-md-offset-3">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="/user/{{ $userData->id }}/edit" role="form">

                <div class="box-body">

                    <div class="form-group{{ $errors->has('staff_id') ? ' has-error' : '' }}">
                        <label for="inputStaff_id" class="col-sm-2 control-label">StaffID</label>

                        <div class="col-sm-10">
                            <input type="text" name="staff_id" class="form-control" id="inputName" placeholder="Staff ID Eg: IT14xxxxxxx" value="{{ $userData->staff_id }}" required disabled>
                            @if ($errors->has('staff_id'))
                                <span class="help-block">
                <strong>{{ $errors->first('staff_id') }}</strong>
            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ $userData->name }}" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ $userData->email }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                        <label for="inputPosition" class="col-sm-2 control-label">Position</label>

                        <div class="col-sm-10">
                            <input type="text" name="position" class="form-control" id="inputPosition" placeholder="Position Eg: Dr, Lecturer" value="{{ old('position') }}" required>
                            @if ($errors->has('staff_id'))
                                <span class="help-block">
                <strong>{{ $errors->first('position') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Update User</button>
                </div>
                <!-- /.box-footer -->
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
            </form>

        </div>
    </div>

@endsection