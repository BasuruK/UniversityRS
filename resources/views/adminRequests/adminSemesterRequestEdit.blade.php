@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Edit Semester Request
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Semester Request</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="container-fluid">

        <script>
            /**
             * Dynamically populate the select options for available resources
             */
            $(document).ready(function()
            {

                $.get("{{ url('/adminRequest/requestForm/loadHallsDate')}}", {option: $('#selectdateEdit').val(),option2: $('#prevtimeslot').val(),option3: $('#reqResourceType').val(), option4: $('#prevbatch').val()},

                        function(data) {

                            var availableHalls = $('#selectResources');

                            availableHalls.empty();

                            $.each(data, function(key, value) {

                                availableHalls

                                        .append($("<option></option>")

                                                .attr("value",key)

                                                .text(key+value));
                            });

                        });

            });
        </script>



        <div class="row">
            <div class="col col-sm-7">
                <div class="box box-primary">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <!-- end .flash-message -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" method="POST" action="/adminRequest/semesterRequestUpdate/{{$adminSemesterRequest->id}}" name="semesterReqEdit">
                        {{method_field('PATCH')}}
                        {!! csrf_field() !!}



                        <!--Date-->
                            <div class="form-group">
                                <label>Day:</label>
                                <select class="form-control" name="selectdateEdit" id="selectdateEdit">
                                    @if($adminSemesterRequest->requestDate=='monday')
                                        <option  value="monday" selected="selected">Monday</option >
                                        <option  value="tuesday">Tuesday</option>
                                        <option  value="wednesday">Wednesday</option>
                                        <option  value="thursday">Thursday</option>
                                        <option  value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                    @elseif($adminSemesterRequest->requestDate=="tuesday")
                                        <option  value="monday">Monday</option>
                                        <option  value="tuesday" selected="selected">Tuesday</option>
                                        <option  value="wednesday">Wednesday</option>
                                        <option  value="thursday">Thursday</option>
                                        <option  value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                    @elseif($adminSemesterRequest->requestDate=="wednesday")
                                        <option  value="monday">Monday</option>
                                        <option  value="tuesday">Tuesday</option>
                                        <option  value="wednesday" selected="selected">Wednesday</option>
                                        <option  value="thursday">Thursday</option>
                                        <option  value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                    @elseif($adminSemesterRequest->requestDate=="thursday")
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday" selected="selected">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                    @elseif($adminSemesterRequest->requestDate=="friday")
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday" selected="selected">Friday</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                    @elseif($adminSemesterRequest->requestDate=="saturday")
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday" selected="selected">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                    @elseif($adminSemesterRequest->requestDate=="sunday")
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday" selected="selected">Sunday</option>
                                    @endif

                                </select>

                            </div>

                            <script>

                                $(document).ready(function() {

                                    $.get("{{ url('/adminRequest/requestForm/loadHallsDate')}}", {
                                                option: $('#selectdateEdit').val(),
                                                option2: $('#selectTimeEdit').val(),
                                                option3: $('#reqResourceType').val(),
                                                option4: $('#prevbatch').val()
                                            },

                                            function (data) {

                                                var availableHalls = $('#selectResources');

                                                availableHalls.empty();

                                                $.each(data, function (key, value) {


                                                    availableHalls

                                                            .append($("<option></option>")

                                                                    .attr("value", key)

                                                                    .text(key + value));
                                                });

                                            });

                                    $('#selectdateEdit').change(function () {


                                        $.get("{{ url('/adminRequest/requestForm/loadHallsDate')}}", {
                                                    option: $(this).val(),
                                                    option2: $('#selectTimeEdit').val()
                                                },

                                                function (data) {

                                                    var availableHalls = $('#selectResources');

                                                    availableHalls.empty();

                                                    $.each(data, function (key, value) {

                                                        availableHalls

                                                                .append($("<option></option>")

                                                                        .attr("value", key)

                                                                        .text(key + value));
                                                    });

                                                });

                                    });

                                });
                            </script>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevbatch" id="prevbatch" value="{{$adminSemesterRequest->batchNo}}">
                            </div>
                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevsub" id="prevsub" value="{{$adminSemesterRequest->subjectCode}}">
                            </div>
                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevtimeslot" id="prevtimeslot" value="{{$adminSemesterRequest->timeSlot}}">
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="reqResourceType" id="reqResourceType" value="{{$adminSemesterRequest->ResourceType}}">
                            </div>



                            {{--Select time slot type--}}
                            <div class="form-group">
                                <label>Time Slot Type</label>
                                <div class="radio">
                                    <label>
                                        @if($adminSemesterRequest->timeslotType=='1')
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="1"  onclick="setSelect('1')" checked>
                                        @else
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="1"  onclick="setSelect('1')" disabled>
                                        @endif
                                        One hour Slot
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        @if($adminSemesterRequest->timeslotType=='2')
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="2"  onclick="setSelect('2')" checked>
                                        @else
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="2"  onclick="setSelect('2')" disabled>
                                        @endif
                                        Two Hour Slot
                                    </label>
                                </div>
                            </div >




                            <script>
                                /**
                                 * Dynamically populate the select options for timeslots
                                 */
                                var OneHourSet=['8.30 - 9.30','9.30 - 10.30','10.30 - 11.30','11.30 - 12.30','12.30 - 14.30','14.30 - 15.30','15.30 - 16.30','16.30 - 17.30','17.30 - 18.30'];
                                var TwoHourSet=['8.30 - 10.30','10.30 - 12.30','14.30 - 16.30','16.30 - 18.30'];


                                function setSelect(v) {
                                    var x = document.getElementById("selectTimeEdit");
                                    for (i = 0; i < x.length; ) {
                                        x.remove(x.length -1);
                                    }
                                    var a;
                                    if (v=='1'){

                                        a = OneHourSet;
                                    } else if (v=='2'){

                                        a = TwoHourSet
                                    }

                                    for (i = 0; i < a.length; ++i) {
                                        if(a[i]==document.getElementById("prevtimeslot").value)
                                        {
                                            var option = document.createElement("option");
                                            option.text = a[i];
                                            option.value = a[i];
                                            option.selected='selected';
                                            x.add(option);
                                        }
                                        else
                                        {
                                            var option = document.createElement("option");
                                            option.value = a[i];
                                            option.text = a[i];
                                            x.add(option);
                                        }
                                    }
                                }
                                function load() {
                                    var currentType=document.semesterReqEdit.SlotTypeEdit.value;

                                    setSelect(currentType);
                                }
                                window.onload = load;
                            </script>




                            <!-- select Time Slot  -->
                            <div class="form-group">
                                <label>Time Slot</label><br>
                                <select class="form-control" name="selectTimeEdit" id="selectTimeEdit">

                                </select>
                            </div>

                            <script>

                                $('#selectTimeEdit').change(function(){



                                    $.get("{{ url('/adminRequest/requestForm/loadHallsTime')}}", {option: $(this).val(),option2: $('#selectdateEdit').val(),option3: $('#reqResourceType').val(),option4: $('#prevbatch').val()},

                                            function(data) {

                                                var availableHalls = $('#selectResources');



                                                availableHalls.empty();

                                                $.each(data, function(key, value) {

                                                    availableHalls

                                                            .append($("<option></option>")

                                                                    .attr("value",key)

                                                                    .text(key+value));

                                                });

                                            });

                                });

                            </script>

                            <div class="form-group">
                                <label>Resource Type</label><br>
                                <p>{{ $adminSemesterRequest->ResourceType }}</p>
                            </div>

                            <!-- select Resource -->
                            <div class="form-group">
                                <label>Resource</label><br>
                                <select class="form-control" name="selectResources" id="selectResources">

                                </select>
                            </div>


                            <div class="form-group">
                                <label>Lecturer</label><br>
                                <p>{{ $requestedUser->name }}</p>
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="reqLect" id="reqLect" value="{{ $requestedUser->name }}">
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="lectID" id="lectID" value="{{ $adminSemesterRequest->lecturerID }}">
                            </div>

                            <div class="form-group">
                                <label>Semester</label><br>
                                <p>{{ $adminSemesterRequest->semester }}</p>
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="reqSemester" id="reqSemester" value="{{ $adminSemesterRequest->semester }}">
                            </div>

                            <div class="form-group">
                                <label>Year</label></br>
                                <p>{{ $adminSemesterRequest->year }}</p>
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="reqYear" id="reqYear" value="{{ $adminSemesterRequest->year }}">
                            </div>

                            <!-- select Batch -->
                            <div class="form-group">
                                <label>Batch</label><br>
                                <p>{{ $batch->batchNo }}</p>
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="reqBatch" id="reqBatch" value="{{ $adminSemesterRequest->batchNo }}">
                            </div>

                            <!-- select Subject -->
                            <div class="form-group">
                                <label>Subject</label><br>
                                <p>{{ $selectedSub->subName }}</p>
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="subId" id="subId" value="{{ $adminSemesterRequest->subjectCode }}">
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="subName" id="subName" value="{{ $selectedSub->subName }}">
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
                        <!--<script>
                                function Success()
                                {
                                    $.notify("Request has been successfully Edited", "success",
                                            {position:"center"}
                                    );
                                }
                            </script>-->

                            <br>
                            <br>
                            <a href="/adminRequest/semesterRequest" class="btn btn-warning">Cancel</a>

                            <button id="submitbtn" type="submit " class="btn btn-primary pull-right" >Submit</button>
                        </form>
                    </div>
                    <!-- /.box-body -->


                </div>
            </div>
        </div>



    </div>
@endsection