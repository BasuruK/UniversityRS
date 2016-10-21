@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
           Semester Request Form
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
            <div class="col col-sm-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Request  Semester Timeslot</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" method="POST" action="/userRequest/semesterRequestForm/add" id="SemesterRequestForm">

                        {!! csrf_field() !!}

                        <!--Date-->
                            <div class="form-group">
                                <label>Day:</label>

                                    <select class="form-control" name="selectdate" id="selectdate">
                                    <option  value="monday">Monday</option>
                                        <option  value="tuesday">Tuesday</option>
                                        <option  value="wednesday">Wednesday</option>
                                        <option  value="thursday">Thursday</option>
                                        <option  value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                    </select>

                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="userID" value="{{Auth::user()->id}}">
                            </div>
                            <div class="form-group" hidden="">
                                <input type="text" hidden="" class="form-control"  name="staffID" value="{{Auth::user()->staff_id}}">
                            </div>

                            {{--Select time slot type--}}
                            <div class="form-group">
                                <label>Time Slot Type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="SlotType" id="SlotType1" value="1"  onclick="setSelect('1hr')" >
                                        One hour Slot
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="SlotType" id="SlotType2" value="2"  onclick="setSelect('2hr')" checked>
                                        Two Hour Slot
                                    </label>
                                </div>
                            </div >

                            <!--Resource Type-->
                            <div class="form-group">
                                <label>Resource Type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ResourceType" id="ResourceType" value="Lecture Hall" checked >
                                        Lecture Hall
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ResourceType" id="ResourceType" value="Lab" >
                                        Lab
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Semester</label>
                                <input type="text" class="form-control" id="selectsemester" name="selectsemester">
                            </div>


                            <script>
                                /**
                                 * Dynamically populate the select options for timeslots
                                 */
                                var OneHourSet=['8.30 - 9.30','9.30 - 10.30','10.30 - 11.30','11.30 - 12.30','12.30 - 14.30','14.30 - 15.30','15.30 - 16.30','16.30 - 17.30','17.30 - 18.30','18.30 - 19.30','19.30 - 20.30'];
                                var TwoHourSet=['8.30 - 10.30','10.30 - 12.30','14.30 - 16.30','16.30 - 18.30','18.30 - 20.30'];


                                function setSelect(v) {
                                    var x = document.getElementById("selecttime");
                                    for (i = 0; i < x.length; ) {
                                        x.remove(x.length -1);
                                    }
                                    var a;
                                    if (v=='1hr'){

                                        a = OneHourSet;
                                    } else if (v=='2hr'){

                                        a = TwoHourSet
                                    }

                                    for (i = 0; i < a.length; ++i) {
                                        var option = document.createElement("option");
                                        option.text = a[i];
                                        x.add(option);
                                    }
                                }
                                function load() {
                                    setSelect('2hr');
                                }
                                window.onload = load;
                            </script>

                            <!-- select Time Slot  -->
                            <div class="form-group">
                                <label>Time Slot</label>
                                <select class="form-control" name="selecttime" id="selecttime">
                                </select>
                            </div>


                            <!-- select Year  -->
                            <div class="form-group">
                                <label>Year</label>

                                <select class="form-control" name="selectyear" id="selectyear">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>


                            <script>
                                /**
                                 * Dynamically populate the select options for batches
                                 */
                                $(document).ready(function()
                                {
                                    $.get("{{ url('/userRequest/requestForm/loadBatches')}}", {option: $('#selectyear').val()},

                                            function(data) {

                                                var selectedbatch = $('#selectbatch');

                                                selectedbatch.empty();

                                                $.each(data, function(key, value) {

                                                    selectedbatch

                                                            .append($("<option></option>")

                                                                    .attr("value",key)

                                                                    .text(value));
                                                });

                                            });
                                    $('#selectyear').change(function(){

                                        $.get("{{ url('/userRequest/requestForm/loadBatches')}}", {option: $(this).val()},

                                                function(data) {

                                                    var selectedbatch = $('#selectbatch');

                                                    selectedbatch.empty();

                                                    $.each(data, function(key, value) {

                                                        selectedbatch

                                                                .append($("<option></option>")

                                                                        .attr("value",key)

                                                                        .text(value));
                                                    });

                                                });

                                    });

                                });


                            </script>

                            <!-- select Batch -->
                            <div class="form-group">
                                <label>Batch</label>
                                <select class="form-control" name="selectbatch" id="selectbatch">
                                </select>
                            </div>
                            <script>
                                /**
                                 * Dynamically populate the select options for subjects
                                 */
                                $(document).ready(function()
                                {
                                    $.get("{{ url('/userRequest/requestForm/loadSubjects')}}", {option: $('#selectyear').val()},

                                            function(data) {

                                                var selectedSub = $('#selectsub');

                                                selectedSub.empty();

                                                $.each(data, function(key, value) {

                                                    selectedSub


                                                            .append($("<option></option>")

                                                                    .attr("value",key)

                                                                    .text(value));
                                                });

                                            });
                                    $('#selectyear').change(function(){

                                        $.get("{{ url('/userRequest/requestForm/loadSubjects')}}", {option: $(this).val()},

                                                function(data) {

                                                    var selectedSub = $('#selectsub');

                                                    selectedSub.empty();

                                                    $.each(data, function(key, value) {

                                                        selectedSub


                                                                .append($("<option></option>")

                                                                        .attr("value",key)

                                                                        .text(value));
                                                    });

                                                });

                                    });

                                });
                            </script>

                            <!-- select Subject -->
                            <div class="form-group">
                                <label>Subject</label>
                                <select class="form-control" name="selectsub" id="selectsub">
                                </select>
                            </div>



                            <div class="alert alert-danger" id="errordisplay" style="display:none">
                                @if (count($errors) > 0)

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>

                                @endif
                            </div>
                            <script>
                                function Success()
                                {
                                    $.notify("Your request has been successfully logged", "success",
                                            {position:"center"}
                                    );
                                }

                                function ValidateSemester()
                                {
                                    //console.log(radioBtn);

                                    var semester=$('#selectsemester').val();



                                    if(semester == "")
                                    {
                                        //set the display value to empty on the style so that the div will be displayed
                                        $("#errordisplay").css('display','');
                                        $('#errordisplay').text("Seemester cannot be empty");
                                        return false;
                                    }
                                    else if(semester>2)
                                    {
                                        $("#errordisplay").css('display','');
                                        $('#errordisplay').text("Semester value must be either 1 or 2");
                                        return false;
                                    }

                                    //submit the form is there are no errors
                                    $('#SemesterRequestForm').submit();
                                    Success();
                                }
                            </script>

                            <button id="submitbtn" type="submit " class="btn btn-primary pull-right" onclick="return ValidateSemester()">Submit</button>
                        </form>
                    </div>
                    <!-- /.box-body -->


                </div>
            </div>
        </div>
    </div>
@endsection