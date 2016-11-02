@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Special Request Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Overview</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Special Requests</h3>
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
                                     * Initialise DataTable for Pending requests
                                     */
                                    $(document).ready(function() {
                                        $('#dataTableRegUsers').DataTable();
                                    } );

                                    /**
                                     * Confirmation messages for delete and edit
                                     */
                                    function isDelete(id)
                                    {
                                        var ID =id;
                                        $.confirm({
                                            theme: 'black',
                                            title: 'Confirm Deletion',
                                            icon: 'fa fa-warning',
                                            content: 'Are you sure want to remove this Special Request?',
                                            confirmButton: 'Yes',
                                            confirmButtonClass: 'btn-danger',
                                            confirm: function(){
                                                location.href="/adminRequest/specialRequestDelete/"+ID;
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
                                            content: 'Are you sure want to Edit this Special Request?',
                                            confirmButton: 'Yes',
                                            confirmButtonClass: 'btn-danger',
                                            confirm: function(){
                                                location.href="/adminRequest/specialRequestEdit/"+ID;
                                            }

                                        });
                                        return false;
                                    }

                                </script>
                                <table id="dataTableRegUsers" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableRegUsers_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Request ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Capacity</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Event Details</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Time Slot</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Resource Type</th>
                                        <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($specialRequests as $specialRequest)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{$specialRequest->id}}</td>
                                            <td>{{$specialRequest->capacity}}</td>
                                            <td>{{$specialRequest->specialEvent}}</td>
                                            <td>{{$specialRequest->requestDate}}</td>
                                            <td>{{$specialRequest->timeSlot}}</td>
                                            <td>{{$specialRequest->ResourceType}}</td>
                                            <td>
                                                <div class="pull-right">
                                                    <a  onclick="return isEdit({{$specialRequest->id}})" class="btn btn-info">Edit</a>
                                                    <a class="btn btn-danger" onclick="return isDelete({{$specialRequest->id}})">Delete</a>
                                                </div>
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
        </div><!--/.row-->
        <!----second box-->
        <div class="row">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Accepted Special Requests</h3>
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
                                     * Initialise DataTable for Accepted requests Users
                                     */
                                    $(document).ready(function() {
                                        $('#dataTableAcceptedSemesterRequests').DataTable();
                                    } );
                                </script>
                                <table id="dataTableAcceptedSpecialRequests" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableRegUsers_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Request ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Capacity</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Event Details</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Time Slot</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Resource Type</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($acceptedSpecialRequests as $acceptedSpecialRequest)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $acceptedSpecialRequest->id }}</td>
                                            <td>{{ $acceptedSpecialRequest->capacity }}</td>
                                            <td>{{ $acceptedSpecialRequest->specialEvent }}</td>
                                            <td>{{ $acceptedSpecialRequest->requestDate }}</td>
                                            <td>{{ $acceptedSpecialRequest->timeSlot }}</td>
                                            <td>{{$acceptedSpecialRequest->ResourceType}}</td>
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
