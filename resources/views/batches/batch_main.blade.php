@extends('layouts.main')

@section('section-header')
<section class="content-header">
    <h1>
        Batch Management
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Batch Management</li>
    </ol>
</section>
@endsection

@section('content')

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

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Batches</h3>
                <a href='/batch/new' id="btnAdd" class="btn btn-primary pull-right">Add Batch</a>
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
                                        content: 'Are you sure want to remove this Batch?',
                                        confirmButton: 'Yes',
                                        confirmButtonClass: 'btn-danger',
                                        confirm: function(){
                                            location.href="/batch/delete/"+ID;
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
                                        content: 'Are you sure want to Edit this Batch?',
                                        confirmButton: 'Yes',
                                        confirmButtonClass: 'btn-danger',
                                        confirm: function(){
                                            location.href="/batch/"+ID;
                                        }

                                    });
                                    return false;
                                }
                            </script>
                            <table id="dataTableRegUsers" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableRegUsers_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Year</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Prefix: activate to sort column ascending" style="width: 45px;">Batch No.</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">No. of Students</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Type</th>

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
                                        <td>{{ $batch->type }}</td>

                                        <td>
                                            <a onclick="return isEdit({{$batch->id}})" class="btn btn-primary">Edit</a>
                                            <a onclick="return isDelete({{$batch->id}})" class="btn btn-danger pull-right">Delete</a>
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
</div>
@endsection