@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>User Management <small>Manage Users</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Management</li>
    </ol>
</section>
@endsection

@section('content')

<!--Box 1-->
<div class="col-md-4">
  <!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Add Users <small> *Users who are allowed to register</small></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" action="/UserManagement/add" role="form">
     
      <div class="box-body">  
        <div class="form-group{{ $errors->has('staff_id') ? ' has-error' : '' }}">
          <label for="inputStaff_id" class="col-sm-2 control-label">StaffID</label>

          <div class="col-sm-10">
            <input type="text" name="staff_id" class="form-control" id="inputStaff_id" placeholder="Staff ID Eg: IT14xxxxxxx" value="{{ old('staff_id') }}" required> 
            @if ($errors->has('staff_id'))
            <span class="help-block">
                <strong>{{ $errors->first('staff_id') }}</strong>
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
        <button type="submit" class="btn btn-info pull-right">Add User</button>
      </div>
      <!-- /.box-footer -->
        {{ csrf_field() }}
    </form>

  </div>


</div>

<script>
/**
* Initialise DataTable for Allowed Users
*/
$(document).ready(function() {
    $('#dataTableAllowedUsers').DataTable();
} );

/**
* Initialise DataTable for Registered Users
*/
$(document).ready(function() {
    $('#dataTableRegUsers').DataTable();
} );

/**
 *
 * @param id
 * @returns {boolean}
 *
 * User confirmation message asking the user to confirm his decision
 */
function isDelete(id)
{
    var ID = id;
    $.confirm({
        theme: 'black',
        title: 'Are Your Sure ?',
        icon: 'fa fa-warning',
        content: 'You will not be able to recover this information again if you delete this entry !',
        confirmButton: 'Yes',
        confirmButtonClass: 'btn-danger',
        confirm: function(){
            location.href = "user/"+ID+"/delete";
        }
    });
    return false;
}

function isEdit(id)
{
    var ID = id;
    $.confirm({
        theme: 'black',
        title: 'Are Your Sure ?',
        icon: 'fa fa-warning',
        content: 'Are you sure you want to edit this entry ?',
        confirmButton: 'Yes',
        confirmButtonClass: 'btn-success',
        confirm: function(){
            location.href = "user/"+ID+"/edit";
        }
    });
    return false;
}

</script>
<!--Data Table-->
<div class="col-md-8">
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Registered Users</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="dataTableRegUsers_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                  <div class="col-sm-6"></div>
                  <div class="col-sm-6"></div>
              </div>
              <div class="row">
                  <div class="col-sm-12">
                      <table id="dataTableRegUsers" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableRegUsers_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Staff ID</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Prefix: activate to sort column ascending" style="width: 45px;">Prefix</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 140px;">Email</th>
                                <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($RegisteredUser as $RegUser)
                            <tr role="row" class="odd">
                                  <td class="sorting_1">{{ $RegUser->staff_id }}</td>
                                  <td>{{ $RegUser->allowedUser->position }}</td>
                                  <td>{{ $RegUser->name }}</td>
                                  <td>{{ $RegUser->email }}</td>
                                  <td>
                                      <a href="#" class="btn btn-info" onclick ="return isEdit( {{ $RegUser->id }} )">Edit</a>
                                      <a href="#" class="btn btn-danger pull-right" onclick="return isDelete( {{ $RegUser->id }} )">Delete</a>
                                  </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5">
                      <div class="dataTables_info" id="dataTableRegUsers_info" role="status" aria-live="polite"></div>
                  </div>
                  <div class="col-sm-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="dataTableRegUsers_paginate"></div>
                  </div>
              </div>
            </div>
        </div>
            <!-- /.box-body -->     
    </div> <!--/.box-->
</div>
<!--/.Data Table-->
@endsection
