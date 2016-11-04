@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>Authorized User Management <small>Edit Authorized User</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>User Management</li>
            <li class="active">Edit User</li>
        </ol>
    </section>
@endsection

@section('content')

    <!--Box 1-->
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Authorized User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="/AuthorizedUser/{{ $userData->id }}/edit" role="form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group">
                        <label for="inputStaff_id" class="col-sm-2 control-label">Staff ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="staff_id" class="form-control" id="inputName" placeholder="Staff ID Eg: IT14xxxxxxx" value="{{ $userData->staff_id }}" required>
                        </div>
                    </div>

                    <!-- Select2 Initializer -->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".select2DropDown").select2()
                        });
                    </script>

                    <div class="form-group">
                        <label for="inputPosition" class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-10">
                            <select name="inputPosition" id="inputPosition" class="form-control" style="width: 100%" required>
                                @foreach($PriorityCat as $cat)
                                    <option value="{{ $cat->id }}"@if($PriorityLevel=== $cat->id) selected @endif>{{ $cat->priorityName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Edit</button>
                    <a href="/UserManagement" class="btn btn-facebook">Back</a>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /.box-footer -->

            </form>
        </div>
    </div>

@endsection