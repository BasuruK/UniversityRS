@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>
       My Requests
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Home</li>
    </ol>
</section>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
                    <div class="box">
        <div class="box-header">
          <h3 class="box-title">My Requests</h3>
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
                      <script>
/**
* Initialise DataTable for Registered Users
*/
$(document).ready(function() {
    $('#dataTableRegUsers').DataTable();
} );
                          
function isDelete(id)
{
    var ID =id;
    $.confirm({
        theme: 'black',
        title: 'Confirm Deletion',
        icon: 'fa fa-warning',
        content: 'Are you sure want to remove this resource?',
        confirmButton: 'Yes',
        confirmButtonClass: 'btn-danger',
        confirm: function(){
            location.href="/userRequest/deleteUserRequest/"+ID;
        }
        
    });
    return false;
}
function isEdit(id)
{
    var ID =id;
    $.confirm({
        theme: 'black',
        title: 'Confirm Deletion',
        icon: 'fa fa-warning',
        content: 'Are you sure want to Edit this resource?',
        confirmButton: 'Yes',
        confirmButtonClass: 'btn-danger',
        confirm: function(){
            location.href="/userRequest/Edit/"+ID;
        }
        
    });
    return false;
}
                      </script>
                      <table id="dataTableRegUsers" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableRegUsers_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Request ID</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Hall Number</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Prefix: activate to sort column ascending" style="width: 45px;">Batch</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Year</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Subject</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Time Slot</th>
                                <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                            <tr role="row" class="odd">
                              <td class="sorting_1">{{$request->id}}</td>
                              <td>{{$request->hallNo}}</td>
                              <td>{{$request->batchNo}}</td>
                              <td>{{$request->year}}</td>
                              <td>{{$request->subName}}</td>
                              <td>{{$request->timeSlot}}</td>
                              <td>
                                  <a  onclick="return isEdit({{$request->id}})" class="btn btn-info">Edit</a>
                                  <a class="btn btn-danger pull-right" onclick="return isDelete({{$request->id}})">Delete</a>
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
</div>
@endsection