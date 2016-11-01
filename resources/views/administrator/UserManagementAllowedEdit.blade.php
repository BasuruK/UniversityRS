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
            <form class="form-horizontal" method="POST" action="/AuthorizedUser/{{ $userData->id }}/edit" role="form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group{{ $errors->has('staff_id') ? ' has-error' : '' }}">
                        <label for="inputStaff_id" class="col-sm-2 control-label">StaffID</label>

                        <div class="col-sm-10">
                            <input type="text" name="staff_id" class="form-control" id="inputName" placeholder="Staff ID Eg: IT14xxxxxxx" value="{{ $userData->staff_id }}" required>
                            @if ($errors->has('staff_id'))
                                <span class="help-block">
                <strong>{{ $errors->first('staff_id') }}</strong>
            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Select2 Initializer -->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".select2DropDown").select2()
                        });
                    </script>

                    <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                        <label for="inputPosition" class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-10">
                            <select name="inputPosition" id="inputPosition" class="select2DropDown form-control" style="width: 100%" required>
                                @foreach($PriorityCat as $cat)
                                    <option value="{{ $cat->id }}"@if($PriorityLevel=== $cat->id) selected @endif>{{ $cat->priorityName }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('position'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('position') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Update User</button>
                    <a href="/UserManagement" class="btn btn-facebook">Back</a>
                </div>
                <!-- /.box-footer -->

            </form>

        </div>
    </div>

@endsection