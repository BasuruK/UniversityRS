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
         * User confirmation message asking the user to confirm his decision
         *
         * @param id
         * @returns {boolean}
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

        /**
         * User confirmation message asking the user to confirm his decision
         *
         * @returns {boolean}
         */
        function ConfirmTimetableTruncate()
        {
            $.confirm({
                theme: 'black',
                title: 'Are Your Sure ?',
                icon: 'fa fa-warning',
                content: 'This will erase all the data related to timetables, Only press yes if it is a must to clear out everything.<br>You wont be able to undo this action later!',
                confirmButton: 'Yes',
                confirmButtonClass: 'btn-danger',
                confirm: function(){

                    $.confirm({
                        theme: 'black',
                        title: 'Are Your Sure ?',
                        icon: 'fa fa-warning',
                        content: 'Confirm your choice!<br><b>Are you sure you want to erase all data?</b></br>' +
                        '<div class="form-group">' +
                            '<br><br>' +
                            '<lable for="checkPasswordTruncate"> Enter your Password: </lable>' +
                            '<input type="password" id="checkPasswordTruncate" class="form-control">' +
                        '</div>',
                        confirmButton: 'Yes',
                        confirmButtonClass: 'btn-danger',
                        confirm: function () {

                            //Check for password authenticity
                            var password = $('#checkPasswordTruncate').val();

                            $.ajax({
                                type    : 'GET',
                                url     : "/AdminOptions/checkPassword/" + password,
                                success : function (status) {

                                    if(status == "true")
                                    {
                                        $.ajax({
                                            type    : 'GET',
                                            url     : "/AdminOptions/truncateTimeTable",
                                            success : function () {
                                                $.notify("Timetable data erased successfully",{
                                                    position : 'bottom right',
                                                    className: 'success'
                                                });
                                            }
                                        });
                                    }
                                    else
                                    {
                                        $.alert({
                                            theme: 'black',
                                            title: 'Error !',
                                            icon: 'fa fa-close',
                                            content: 'Password Incorrect!'
                                        });
                                    }
                                }
                            });
                        }
                    });
                }
            });
            return false;
        }

        /**
         *
         * Clears the time table according to the batch and the year given
         *
         * @returns {boolean}
         * @constructor
        */
        function CustomClearTimetable() {

            $.confirm({
                keyboardEnabled: true,
                theme: 'black',
                title: 'Enter Year and Batch!',
                icon: 'fa fa-info',
                content:'Please enter Year and the Batch No <br xmlns="http://www.w3.org/1999/html"><br> ' +
                '<div class="from-group">' +
                    '<input name="yearDelete" id="yearDelete" type="text" class="form-control" placeholder="Year. i.e : 3" />' +
                    '<br> ' +
                    '<input name="batchDelete" id="batchDelete" class="form-control" type="text" placeholder="Batch No. i.e : 1" />' +
                    '<br>' +
                    '<input type="checkbox" id="checkSemesterTimetable" required> ' +
                    '<label for="checkSemesterTimetable"> Clear from Semester Requests Timetables</label>' +
                    '<br>' +
                    '<input type="checkbox" id="checkFormalTimetable" required> ' +
                    '<label for="checkFormalTimetable"> Clear from Formal Requests Timetables</label>' +
                '</div>',
                confirmButton: 'Yes',
                confirmButtonClass: 'btn-warning',
                confirm: function () {

                    var year = document.getElementById('yearDelete').value;
                    var batch = document.getElementById('batchDelete').value;
                    var semesterTimetableOption = $('#checkSemesterTimetable');
                    var formalRequestTimetableOption =$('#checkFormalTimetable');

                    if(year == "" || batch == "" || (semesterTimetableOption.is(':checked') == false && formalRequestTimetableOption.is(':checked') == false))
                    {
                        $.alert({
                            theme: 'black',
                            title: 'Error !',
                            icon: 'fa fa-close',
                            content: 'One or more fields not set!'

                        });
                    }
                    else
                    {

                        $.confirm({
                            keyboardEnabled: true,
                            theme: 'black',
                            title: 'Are you sure ?',
                            icon: 'fa fa-warning',
                            content: 'Are you sure you want to delete all the entries related to Batch ' + batch + ' of Year ' + year + ' ? <br>You cannot undo this operation! ' +
                            '<br><br>' +
                            '<div class="form-group" ' +
                                '<lable for="checkPasswordBatchAndYear"> Enter your Password: </lable>' +
                                '<input type="password" id="checkPasswordBatchAndYear" class="form-control">' +
                            '</div>',
                            confirmButton: 'Yes',
                            confirmButtonClass: 'btn-danger',
                            confirm: function () {

                                //Check for password authenticity
                                var password = $('#checkPasswordBatchAndYear').val();

                                $.ajax({
                                    type    : 'GET',
                                    url     : "/AdminOptions/checkPassword/" + password,
                                    success : function (status) {

                                        if(status == "true")
                                        {
                                            $.ajax({
                                                type    : 'GET',
                                                url     : "/AdminOptions/customClearTables/"+batch+"/"+year+"/"+semesterTimetableOption+"/"+formalRequestTimetableOption,
                                                success : function () {
                                                    $.notify("Timetable data for Batch " + batch + "of Year " + year + " erased successfully",{
                                                        position : 'bottom right',
                                                        className: 'success'
                                                    });
                                                }
                                            });
                                        }
                                        else
                                        {
                                            $.alert({
                                                theme: 'black',
                                                title: 'Error !',
                                                icon: 'fa fa-close',
                                                content: 'Password Incorrect!'
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    }
                }
            });
            return false;
        }

        /**
         * Completely reset the system. Redirect the user to login
         * Proceed with care
         *
         * @constructor
        */
        function MasterReset()
        {
            $.confirm({
                theme: 'black',
                title: 'Are Your Sure ?',
                icon: 'fa fa-warning',
                content: 'This will clear everything in the databases and reset all the values to default values.<br>You cannot undo this action.<br>Once you press yes you will be redirected to login where you have to login using your default administrator credentials.',
                confirmButton: 'Yes',
                confirmButtonClass: 'btn-danger',
                confirm: function(){

                    $.confirm({
                        theme: 'black',
                        title: 'Are Your Sure ?',
                        icon: 'fa fa-warning',
                        content: 'Confirm your choice!<br><b>Are you sure you want to erase all data?</b></br>' +
                        '<br><br>' +
                        '<div class="form-group" ' +
                                '<lable for="checkPasswordMasterReset"> Enter your Password: </lable>' +
                        '<input type="password" id="checkPasswordMasterReset" class="form-control">' +
                        '</div>',
                        confirmButton: 'Yes',
                        confirmButtonClass: 'btn-danger',
                        confirm: function () {

                            //Check for password authenticity
                            var password = $('#checkPasswordMasterReset').val();

                            $.ajax({
                                type    : 'GET',
                                url     : "/AdminOptions/masterReset/" + password,
                                success : function (status) {
                                    if($.parseJSON(status) == false)
                                    {
                                        $.alert({
                                            theme: 'black',
                                            title: 'Error !',
                                            icon: 'fa fa-close',
                                            content: 'Password Incorrect!'
                                        });
                                    }
                                    else
                                    {
                                        location.href = "/logout";
                                    }
                                }
                            });
                        }
                    });
                }
            });
        }

        function DatabaseBackup()
        {

            $.ajax({
                type: 'GET',
                url: "/AdminOptions/databaseBackup",
                success: function (filePath) {
                    this.http.post();
                }
            });
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
                            <label for="year">Year :</label>
                            <select name="year" id="year" class="js-example-responsive form-control" style="width: 100%" required>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="semester">Semester :</label>
                            <select name="semester" id="semester" class="js-example-responsive form-control" style="width: 100%" required>
                                <option>1</option>
                                <option>2</option>
                            </select>
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
                        <input type="submit" class="btn btn-primary form-control" value="Save and notify users" onclick="//return submitForm()">
                    </div>
                        <br><br><br>
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
            <div class="box box-success">
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

        <!-- Database Operations -->
        <div class="col-md-8">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Database Operations</h3> <small> *Database related operations</small>
                </div>
                <div class="box-body">

                    <p><b>All the functions listed here handel operations with critical data. Handle with extreme care and proceed at your own risk.</b></p>
                    <br>

                    <div class="col-lg-12">
                        <div class="col-lg-5">
                            <a class="btn btn-warning" onclick="ConfirmTimetableTruncate()">Clear Timetable</a>
                        </div>
                        <div class="col-lg-7">
                            <p>This will clear all information on timetables.</p>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="col-lg-12">
                        <div class="col-lg-5">
                            <a class="btn btn-warning" onclick="CustomClearTimetable()">Clear Semester Timetable (Custom)</a>
                        </div>
                        <div class="col-lg-7">
                            <p>This will clear all information according to the Batch No and the Year given.</p>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="col-lg-12">
                        <div class="col-lg-5">
                            <a href="/AdminOptions/databaseBackup" class="btn btn-warning" onclick="">Database Backup</a>
                        </div>
                        <div class="col-lg-7">
                            <p>This will perform a backup of the entire system and save the file.</p>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="col-lg-12">
                        <div class="col-lg-5">
                            <a class="btn btn-danger" onclick="MasterReset()">Master Reset</a>
                        </div>
                        <div class="col-lg-7">
                            <p>This will perform a master reset of the entire system and the user will be redirected to login where the default username and password should be used to login to the system again.</p>
                        </div>
                    </div>
                    <br>
                    <hr>

                </div><!-- ./box-body -->
            </div>
        </div>

    </div><!-- ./row -->

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