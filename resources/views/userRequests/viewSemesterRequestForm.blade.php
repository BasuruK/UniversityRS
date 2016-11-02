@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            My Requests
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Home</li>
            <li class="active">User Request</li>
            <li class="active">View Semester Requests</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">My Semester Requests</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="flash-message" id="errordisplay">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
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
                                            content: 'Are you sure want to remove this Semester Request?',
                                            confirmButton: 'Yes',
                                            confirmButtonClass: 'btn-danger',
                                            confirm: function(){
                                                location.href="/userRequest/deleteSemesterRequest/"+ID;
                                            }

                                        });
                                        return false;
                                    }
                                    function isEdit(id)
                                    {
                                        var ID =id;
                                        $.confirm({
                                            theme: 'black',
                                            title: 'Confirm Edit',
                                            icon: 'fa fa-warning',
                                            content: 'Are you sure want to Edit this Semester Request?',
                                            confirmButton: 'Yes',
                                            confirmButtonClass: 'btn-danger',
                                            confirm: function(){
                                                location.href="/userRequest/EditSemesterRequest/"+ID;
                                            }

                                        });
                                        return false;
                                    }
                                    {{--function LoadEdit(id) {--}}
                                    {{--var ID=id;--}}

                                    {{--$.get("{{ url('/userRequest/Edit/loadEditDetails')}}", {option:id})--}}
                                    {{--}--}}

                                </script>
                                <table id="dataTableRegUsers" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableRegUsers_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Request ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Prefix: activate to sort column ascending" style="width: 45px;">Batch</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Year</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Semester</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Subject</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Time Slot</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Resource Type</th>
                                        <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requests as $request)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{$request->id}}</td>
                                            <td>{{$request->batchNo}}</td>
                                            <td>{{$request->year}}</td>
                                            <td>{{$request->semester}}</td>
                                            <td>{{$request->subName}}</td>
                                            <td>{{$request->requestDate}}</td>
                                            <td>{{$request->timeSlot}}</td>
                                            <td>{{$request->ResourceType}}</td>
                                            <td>
                                                 <div class="pull-right">
                                                <a  onclick="return isEdit({{$request->id}})" class="btn btn-primary">Edit</a>
                                                <a class="btn btn-danger " onclick="return isDelete({{$request->id}})">Delete</a>
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
                    <h3 class="box-title">Accepted Semester Requests</h3>
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
                                        $('#dataTableAcceptedRequests').DataTable();
                                    } );
                                </script>
                                <table id="dataTableAcceptedRequests" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableRegUsers_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Request ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Batch</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 140px;">Year</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Semester</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 140px;">Subject</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 140px;">Time Slot</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Resource Type</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Lecture Hall/Lab</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($acceptedrequests as $acceptedrequest)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $acceptedrequest->id }}</td>
                                            <td>{{ $acceptedrequest->batchNo }}</td>
                                            <td>{{ $acceptedrequest->year }}</td>
                                            <td>{{$request->semester}}</td>
                                            <td>{{ $acceptedrequest->subName }}</td>
                                            <td>{{$acceptedrequest->requestDate}}</td>
                                            <td>{{ $acceptedrequest->timeSlot }}</td>
                                            <td>{{$acceptedrequest->ResourceType}}</td>
                                            <td>{{$acceptedrequest->resourceID}}</td>

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
