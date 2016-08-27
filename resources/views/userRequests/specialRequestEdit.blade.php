@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Edit Special Request
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
                        <h3 class="box-title">Edit Timeslot</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" method="POST" action="/userRequest/updateUserRequest/{{$userRequest->id}}"  name="editrequesForm">
                        {{method_field('PATCH')}}
                        {!! csrf_field() !!}

                        <!--Date-->
                            <div class="form-group">
                                <label>Date:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="selectdateEdit" value="{{$userRequest->requestDate}}">

                                    <script type="text/javascript">
                                        $(function() {
                                            $('input[name="selectdateEdit"]').daterangepicker({
                                                singleDatePicker: true,
                                                //   minDate:new Date(),
                                                maxDate:'2016-12-31',
                                                locale: {
                                                    format: 'YYYY-MM-DD-ddd'
                                                },
                                            });

                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="userID" value="{{Auth::user()->id}}">
                            </div>
                            <div class="form-group" hidden="">
                                <input type="text" hidden="" class="form-control"  name="staffID" value="{{Auth::user()->staff_id}}">
                            </div>
                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevhall" id="prevhall" value="{{$userRequest->resourceID}}">
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevtimeslot" id="prevtimeslot" value="{{$userRequest->timeSlot}}">
                            </div>

                            {{--Select time slot type--}}
                            <div class="form-group">
                                <label>Time Slot Type</label>

                                <div class="radio">
                                    <label>
                                        @if($userRequest->timeslotType=='3')
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="3"  onclick="setSelect('3')" checked>
                                        @else
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="3"  onclick="setSelect('3')" >
                                        @endif
                                        Special events
                                    </label>
                                </div>

                            </div>

                            <div  class="form-group">
                                <label>Start Time</label>
                                <input  type="text" class="form-control"  id="selectTimeSpecialST" name="selectTimeSpecialST">

                                <script>
                                    $('#selectTimeSpecialST').timepicker({'timeFormat': 'h:i', 'minTime': '8:00',
                                        'maxTime': '4:30', });



                                </script>

                                <label>End Time</label>
                                <input  type="text" class="form-control"  id="selectTimeSpecialEN" name="selectTimeSpecialEN">

                                <script>
                                    $('#selectTimeSpecialEN').timepicker({'timeFormat': 'h:i' , 'minTime': '8:30',
                                        'maxTime': '5:30',});

                                </script>
                            </div>

                            <script>

                                $('#selectTimeSpecialST').change(function ()
                                {
                                    start_time=$('#selectTimeSpecialST').val();
                                    end_time=$('#selectTimeSpecialEN').val();
                                    var special=start_time+ "-" +end_time;


                                    $('#selecttimeEdit').empty();
                                    $('#selecttimeEdit').val(special);

                                    $.get("{{ url('/userRequest/requestForm/loadHallsDate')}}", {option: $('#selectdateEdit').val(),option2: $('#selecttimeEdit').val()},

                                            function(data) {

                                                var availableHalls = $('#selectresEdit');

                                                availableHalls.empty();

                                                $.each(data, function(key, value) {

                                                    if(key==$('#prevhall').val())
                                                    {
                                                        availableHalls

                                                                .append($("<option selected='selected'></option >")

                                                                        .attr("value",key)

                                                                        .text(key+value));


                                                    }
                                                    else
                                                    {
                                                        availableHalls

                                                                .append($("<option></option>")

                                                                        .attr("value",key)

                                                                        .text(key+value));
                                                    }
                                                });

                                            });
                                });
                            </script>

                            <script>
                                $('#selectTimeSpecialEN').change(function ()
                                {

                                    start_time=$('#selectTimeSpecialST').val();
                                    end_time=$('#selectTimeSpecialEN').val();
                                    var special=start_time+ "-" +end_time;
                                    $('#selecttimeEdit').empty();
                                    $('#selecttimeEdit').val(special);


                                    $.get("{{ url('/userRequest/requestForm/loadHallsDate')}}", {option: $('#selectdateEdit').val(),option2: $('#selecttimeEdit').val()},

                                            function(data) {

                                                var availableHalls = $('#selectresEdit');

                                                availableHalls.empty();

                                                $.each(data, function(key, value) {


                                                    if(key==$('#prevhall').val())
                                                    {
                                                        availableHalls

                                                                .append($("<option selected='selected'></option >")

                                                                        .attr("value",key)

                                                                        .text(key+value));


                                                    }
                                                    else
                                                    {
                                                        availableHalls

                                                                .append($("<option></option>")

                                                                        .attr("value",key)

                                                                        .text(key+value));
                                                    }
                                                });

                                            });
                                });
                            </script>


                            <!-- special event -->
                            <div class="form-group">
                                <label>Special event details</label>
                                <input class="form-control" type="text" name="specialEventEdit" id="specialEventEdit" value="{{$userRequest->specialEvent}}">

                            </div>



                            <!-- select Time Slot  -->
                            <div class="form-group">

                                <label>Time Slot</label><br>
                                <p>Previous Time Slot: {{$userRequest->timeSlot}}</p>
                                <input type="text" class="form-control" name="selecttimeEdit" id="selecttimeEdit" value=" {{$userRequest->timeSlot}}" readonly="readonly">
                                </input>
                            </div>

                            <script>
                                /**
                                 * Dynamically populate the select options for resources
                                 */
                                $(document).ready(function()
                                {

                                    $.get("{{ url('/userRequest/requestForm/loadHallsDate')}}", {option: $('#selectdateEdit').val(),option2: $('#selecttimeEdit').val()},

                                            function(data) {

                                                var availableHalls = $('#selectresEdit');

                                                availableHalls.empty();

                                                $.each(data, function(key, value) {

                                                    if(key==$('#prevhall').val())
                                                    {
                                                        availableHalls

                                                                .append($("<option selected='selected'></option >")

                                                                        .attr("value",key)

                                                                        .text(key+value));


                                                    }
                                                    else
                                                    {
                                                        availableHalls

                                                                .append($("<option></option>")

                                                                        .attr("value",key)

                                                                        .text(key+value));
                                                    }
                                                });

                                            });
                                    $('#selectdateEdit').change(function(){

                                        $.get("{{ url('/userRequest/requestForm/loadHallsDate')}}", {option: $(this).val(),option2: $('#selecttimeEdit').val()},

                                                function(data) {

                                                    var availableHalls = $('#selectresEdit');

                                                    availableHalls.empty();

                                                    $.each(data, function(key, value) {
                                                        if(key==$('#prevhall').val())
                                                        {
                                                            availableHalls

                                                                    .append($("<option selected='selected'></option >")

                                                                            .attr("value",key)

                                                                            .text(key+value));


                                                        }
                                                        else
                                                        {
                                                            availableHalls

                                                                    .append($("<option></option>")

                                                                            .attr("value",key)

                                                                            .text(key+value));
                                                        }

                                                    });

                                                });

                                    });

                                });

                            </script>

                            <script>

                                /**
                                 * Dynamically populate the select options for resources
                                 */
                                $(document).ready(function()
                                {
                                    $('#selecttimeEdit').change(function(){

                                        $.get("{{ url('/userRequest/requestForm/loadHallsTime')}}", {option: $(this).val(),option2:$('#selectdateEdit').val() },

                                                function(data) {

                                                    var availableHalls = $('#selectresEdit');

                                                    availableHalls.empty();

                                                    $.each(data, function(key, value) {


                                                        if(key==$('#prevhall').val())
                                                        {
                                                            availableHalls

                                                                    .append($("<option selected='selected'></option >")

                                                                            .attr("value",key)

                                                                            .text(key+value));


                                                        }
                                                        else
                                                        {
                                                            availableHalls

                                                                    .append($("<option></option>")

                                                                            .attr("value",key)

                                                                            .text(key+value));
                                                        }
                                                    });

                                                });

                                    });

                                });

                            </script>


                            <!-- select Hall -->
                            <div class="form-group">

                                <label>Lecture Hall/Lab</label><br>
                                <p>Previous Lecture Hall/Lab: {{$userRequest->resourceID}}</p>

                                <select class="form-control" name="selectresEdit" id="selectresEdit">
                                </select>
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
                            <script>
                                function Success()
                                {
                                    $notify("Your request has been successfully Edited", "success",
                                            {position:"center"}
                                    );
                                }
                            </script>

                            <button id="submitbtn" type="submit " class="btn btn-primary pull-right" onclick="return Success()">Submit</button>

                    </div>

                    </form>
                </div>
                <!-- /.box-body -->


            </div>
        </div>
    </div>
    </div>
@endsection