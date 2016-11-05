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
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
    <div class="container-fluid">
        <div class="row">
            <div class="col col-sm-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add a New Subject</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" method="POST" action="/subject/Add_Subject">

                            <div class="form-group">
                                <label for="subjectCode">Subject Code</label>
                                <input type="text" class="form-control" id="subjectCode" name="subjectCode" placeholder="Enter Subject Code..."/>
                            </div>

                            <div class="form-group">
                                <label for="subjectName">Subject Name</label>
                                <input type="text" class="form-control" id="subjectName" name="subjectName" placeholder="Enter Subject Name..."/>
                            </div>

                            <div class="form-group">
                                <label for="year">Year</label>
                                <select class="form-control" name="selectyear" id="selectyear">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <div class="form-group">
                                    <select class="form-control" name="selectsemester" id="selectsemester">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="/subject" class="btn btn-primary">Cancel</a>
                            </div>
                            <!-- /.box-body -->

                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            </div>
            <div class="col col-sm-8">
                <script>
                    /**
                     * Initialise DataTable for subjects
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
                            content: 'Are you sure want to remove this subject?',
                            confirmButton: 'Yes',
                            confirmButtonClass: 'btn-danger',
                            confirm: function(){
                                location.href="/subject/delete/"+ID;
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
                            content: 'Are you sure want to Edit this subject?',
                            confirmButton: 'Yes',
                            confirmButtonClass: 'btn-danger',
                            confirm: function(){
                                location.href="/subject/edit/"+ID;
                            }

                        });
                        return false;
                    }
                </script>
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
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Subject ID: activate to sort column descending" style="width: 30px;" aria-sort="ascending">Subject ID</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="subject code: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Subject Code</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Subject Name: activate to sort column ascending" style="width: 150px;">Subject Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Semester: activate to sort column ascending" style="width: 20px;">Semester</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Year: activate to sort column ascending" style="width: 20px;">Year</th>
                                            <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($subjects as $sub)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $sub->id }}</td>
                                                <td>{{$sub->subCode}}</td>
                                                <td>{{$sub->subName}}</td>
                                                <td>{{$sub->semester}}</td>
                                                <td>{{$sub->year}}</td>
                                                <td>
                                                    <div class="pull-right">
                                                        <a onclick="return isEdit({{ $sub->id }})" class="btn btn-primary">Edit</a>
                                                        <a onclick="return isDelete({{ $sub->id }})" class="btn btn-danger">Delete</a>
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
                <!--/.Data Table-->
            </div>
        </div>
    </div>
@endsection