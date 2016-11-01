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

    <!-- <div class="col-md-12"> -->

        <!-- <div class="box with-border"> -->
            <br>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->

            <!-- /.box-header -->
            <div class="col-md-4">
                <div class="box pull-left">



                    <!-- /.box-header -->


                    <!-- form start -->
                    <form role="form" method="POST" action="{{ url('/batch/batch_add') }}">

                        <div class="box-body">

                            <h3 class="box-title">Add a Batch</h3>
                            <br>

                            <div class="form-group">
                                <label for="batchNo">Batch No</label>
                                <input type="text" class="form-control" id="batchNo" name="batchNo" placeholder="Enter Batch Number..."/>
                            </div>

                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="text" class="form-control" id="year" name="year" placeholder="Enter Year..."/>
                            </div>

                            <div class="form-group">
                                <label for="noStudents">No. of Students</label>
                                <input type="text" class="form-control" id="noStudents" name="noStudents" placeholder="Enter Number of Students..."/>
                            </div>

                            <div class="form-group">
                                <label for="selectType">Type</label>
                                <select class="form-control" name="selectType" id="selectType">
                                    <option value="weekday">Weekday</option>
                                    <option value="weekend">Weekend</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">Add Batch</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
            <!-- End of Add Form -->
        <!-- </div> -->

        <!-- Start of Table View -->
        <div class="col-md-8">
            <div class="box">

                <div class="box-body">
                    <h3 class="box-title">Batches</h3>
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
                                        <th tabindex="0"  rowspan="1" colspan="2" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
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
                                                <a onclick="return isEdit({{$batch->id}})" class="btn btn-primary"> Edit </a>

                                                <a onclick="return isDelete({{$batch->id}})" class="btn btn-danger pull-right">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
        </div>
            <!-- /.box-body -->
    <!-- </div> --> <!--/.box-->
</div>
    <!-- Data Table End -->
@endsection