@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>Administrator Options <small>Settings</small></h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Administrator Options</li>
        </ol>
    </section>
@endsection

@section('content')

    <script>
        /**
         * Initialise DataTable for Registered Users
         */
        $(document).ready(function() {
            $('#dataTableDeadline').DataTable();
        } );


        /**
         *
         * @param id
         * @returns {boolean}
         *
         * User confirmation message asking the user to confirm his decision
         */
        function DeadlineDelete(id)
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
                    location.href = "AdminOptions/"+ID+"/DeadlineDelete";
                }
            });
            return false;
        }


    </script>

    <div class="row">
        <div class="col-md-4">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Assign Deadlines<small> *Assign a deadline for semester begining timetables</small></h3>
                </div>
                <div class="box-body">
                    <form role="form" method="POST" action="/AdminOptions/DeadlineSave">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="semester">Semester :</label>
                            <input type="text" name="semester" id="semester" class="form-control" placeholder="Semester" required>
                        </div>

                        <div class="form-group">
                            <label for="year">Year :</label>
                            <input type="text" name="year" id="year" class="form-control" placeholder="year" required>
                        </div>

                        <div class="form-group">
                            <label for="datepicker">Date:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="datepicker" id="datepicker"  class="form-control datepicker" required>

                            </div>
                            <!-- /.input group -->
                        </div>

                    <div class="box-footer pull-right">
                        <button type="button" class="btn btn-primary form-control" value="Save and notify users" onclick="return submitForm()">Save and notify users</button>
                    </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>


        <!--Data Table-->
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Deadlines  <small> *Dealines for semesters</small></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="dataTableDeadline_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="dataTableDeadline" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableDeadline_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTableDeadline" rowspan="1" colspan="1" aria-label="Semester: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Semester</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableDeadline" rowspan="1" colspan="1" aria-label="Year: activate to sort column ascending" style="width: 45px;">Year</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTableDeadline" rowspan="1" colspan="1" aria-label="Deadline: activate to sort column ascending" style="width: 110px;">Deadline</th>
                                        <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Deadlines as $deadline)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $deadline->semester }}</td>
                                            <td>{{ $deadline->year }}</td>
                                            <td>{{ $deadline->deadline }}</td>
                                            <td>
                                                <a href="#" class="btn btn-danger" onclick="return DeadlineDelete({{ $deadline->id }})">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="dataTableDeadline_info" role="status" aria-live="polite"></div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTableDeadline_paginate"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.box-body -->
            </div> <!--/.box-->
        </div> <!--/.Data Table-->

    </div>

        <script>

        //Date picker initializer
        $('.datepicker').datepicker({
            autoclose: true,
            startDate: '-0d',
        });

        //Check box for Semester vice form
        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-red',
                increaseArea: '20%' // optional
            });
        });


    </script>


    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <i class="fa fa-gears"></i>
                    <h3 class="box-title">Options</h3> <small> *Enable or disable options</small>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input type="checkbox" id="semesterRegForm"> <i id="enableOrDisableSemRegForm" style="padding-left: 3%;"> Enable semester registration form </i>
                    <br><br>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <script>


        //Check for already selected variables
        adminOptionsFromServer = <?php echo json_encode($AdminOptions) ?>;
        var cancelEvent = 0; // cancelEvent variable stops notify js popup if user press cancel in the alert message.


        //Semester vice form
        if(adminOptionsFromServer.semesterRequestForm == 1)
        {
            $('#semesterRegForm').iCheck('check');
            document.getElementById("enableOrDisableSemRegForm").innerHTML = "Disable semester registration form";
        }

        //Ajax call for checkbox check Semester vice Reg form
        $('#semesterRegForm').on('ifChecked', function(event){

            cancelEvent = 1;
                $.confirm({
                    theme: 'black',
                    title: 'Are Your Sure ?',
                    icon: 'fa fa-warning',
                    content: 'Are you sure you want to enable the Semester Requests Form ?',
                    confirmButton: 'Yes',
                    confirmButtonClass: 'btn-success',
                    confirm: function(){

                        $.ajax({
                            type    : 'GET',
                            url     : "/AdminOptions/SemesterDeadlineChecked",
                            success : function () {

                                $.notify("Semester Request form enabled",{

                                    position : 'bottom right',
                                    className: 'success'
                                });
                                document.getElementById("enableOrDisableSemRegForm").innerHTML = "Disable semester registration form";
                                cancelEvent = 0;
                            }
                        });
                    },
                    cancel: function () {
                            $('#semesterRegForm').iCheck('uncheck');
                        cancelEvent = 1;
                    }
                });


            });

        //Ajax call for checkbox un-check Semester vice Reg form
        $('#semesterRegForm').on('ifUnchecked', function(event){

            if(cancelEvent != 1) {
                $.ajax({
                    type: 'GET',
                    url: "/AdminOptions/SemesterDeadlineUnchecked",
                    success: function () {

                        $.notify("Semester Request form disabled", {position: 'bottom right'});
                        document.getElementById("enableOrDisableSemRegForm").innerHTML = "Enable semester registration form";
                    }
                });
            }

        });


        //Ajax call to save and notify users
        function submitForm() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').attr('content')
                }
            });

            $.ajax({
                url: '/AdminOptions/DeadlineSave',
                data: $('form').serialize(),
                dataType: 'JSON',
                type: 'POST',
                async: true,
                success: function (data) {
                },
                error: function (data) {
                    console.log(data.responseJSON);
                }
            });

            //location.reload();
        }
    </script>

@endsection