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
            <input type="text" name="position" class="form-control" id="inputPosition" placeholder="Position Eg: Dr, Lecturere" value="{{ old('position') }}" required>
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

<!--Tables-->
<div class="col-xs-8">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Registered Users</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
              <div class="col-sm-6">
                  <div class="dataTables_length" id="example1_length">
                      <label>Show 
                          <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                          <option value="10">10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          </select> entries
                      </label>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div id="example1_filter" class="dataTables_filter">
                      <label>Search : <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                      </label>
                  </div>
              </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" aria-sort="ascending">Staff ID</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Prefix
                            </th> 
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Name
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Email
                            </th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr role="row" class="odd">
                          <td class="sorting_1">IT14020254</td>
                          <td>Dr</td>
                          <td>Basuru Kusal</td>
                          <td>bestbasuru@live.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
          <div class="row">
              <div class="col-sm-5">
                  <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
              </div>
              <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                      <ul class="pagination">
                          <li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                          </li>
                          <li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
                          </li>
                          <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a>
                          </li>
                          <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a>
                          </li>
                          <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a>
                          </li>
                          <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a>
                          </li>
                          <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a>
                          </li>
                          <li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li
                      </ul>
                    </div>
                  </div>
              </div>
          </div>
    </div>
    <!-- /.box-body -->
  </div>
</div>
@endsection
