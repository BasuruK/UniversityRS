@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>
        Subject Management
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Overview</li>
    </ol>
</section>
@endsection

@section('content')
    <script>
        /**
         * Initialise DataTable for Registered Users
         */
        $(document).ready(function() {
            $('#dataTableRegUsers').DataTable();
        } );
    </script>
    <div class="row">
        <!--Data Table-->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Subjects</h3>
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
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Subject ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Subject ID</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="subject code: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Subject Code</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Subject Name: activate to sort column ascending" style="width: 45px;">Subject Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Semester: activate to sort column ascending" style="width: 110px;">Semester</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Year: activate to sort column ascending" style="width: 140px;">Year</th>
                                        <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                                    </tr>
                                    </thead>
                                    <a href='/subject/new' id="btnAdd" class="btn btn-primary">Add Subject</a>
                                    <br><br>
                                    <tbody>
                                    @foreach($subjects as $sub)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $sub->id }}</td>
                                            <td>{{$sub->subCode}}</td>
                                            <td>{{$sub->subName}}</td>
                                            <td>{{$sub->semester}}</td>
                                            <td>{{$sub->year}}</td>
                                            <td>
                                                <a href='/subject/edit/{{ $sub->id }}' id="btnEdit" class="btn btn-primary">Edit</a>
                                                <a href='/subject/delete/{{ $sub->id }}' id="btnDelete" class="btn btn-danger">Delete</a>
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
    </div>
@endsection