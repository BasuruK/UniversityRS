@extends('layouts.main')

@section('section-header')
<section class="content-header">
    <h1>
        Batch Management
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Overview</li>
    </ol>
</section>
@endsection

@section('content')
<!--
<div class="container-fulid">
    <div class="container">
    <div class="row">
        <a href='/batch/new' id="btnAdd" class="btn btn-primary">Add Batch</a>
        <table class="table table-bordered">
            <th></th>
            <tr>
                <th>Batch No.</th>
                <th>Year</th>
                <th>No. of Students</th>     
            </tr>
            @foreach($batches as $batch)
                <tr>
                    <td>{{$batch->batchNo}}</td>
                    <td>{{$batch->year}}</td>
                    <td>{{$batch->noOfStudents}}</td>
                    <td><a href="/batch/{{$batch->id}}" id="btnEdit" class="btn btn-primary">Edit</a></td>
                    <td><a href="/batch/delete/{{$batch->id}}" id="btnDelete" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach

        </table>
    </div>
        </div>
</div> -->

<script>
/**
* Initialise DataTable for Allowed Users

$(document).ready(function() {
    $('#dataTableAllowedUsers').DataTable();
} );*/

/**
* Initialise DataTable for Registered Users
*/
$(document).ready(function() {
    $('#dataTableRegUsers').DataTable();
} );
</script>
<!--Data Table-->
<div class="container-fulid">
    <div class="container">

<div class="col-md-8">
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Batches</h3>
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
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Year</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Prefix: activate to sort column ascending" style="width: 45px;">Batch No.</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">No. of Students</th>
                                <!-- <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 140px;">Email</th> -->
                                <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($batches as $batch)
                            <tr role="row" class="odd">
                              <td class="sorting_1">{{ $batch->year }}</td>
                              <td>{{ $batch->batchNo }}</td>
                              <td>{{ $batch->noOfStudents }}</td>
                              
                              <td>
                                  <a href="/batch/{{$batch->id}}" class="btn btn-info">Edit</a>
                                  <a href="/batch/delete/{{$batch->id}}" class="btn btn-danger pull-right">Delete</a>
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
<!-- Data Table End -->
    </div></div>
@endsection