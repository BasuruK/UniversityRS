@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Edit Special Request
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Home</li>
            <li class="active">User Request</li>
            <li class="active">Edit Special Event Requests</li>
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
                        <form role="form" method="POST" action="/userRequest/updateUserRequest/{{$userRequest->id}}"  name="editrequesFormSpecial">
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
                                <input type="text"  class="form-control"  name="prevtimeslot" id="prevtimeslot" value="{{$userRequest->timeSlot}}">
                            </div>
                            <div class="form-group"  hidden=""> >
                                <input type="text"  class="form-control"  name="prevRtype" id="prevRtype" value="{{$userRequest->ResourceType}}">
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

                            <!--Resource Type-->
                            <div class="form-group">
                                <label>Resource Type</label>
                                <div class="radio">
                                    <label>
                                        @if($userRequest->ResourceType=='LectureHall')
                                            <input type="radio" name="ResourceTypeEdit" id="ResourceTypeEdit" value="LectureHall" checked >
                                        @else
                                            <input type="radio" name="ResourceTypeEdit" id="ResourceTypeEdit" value="LectureHall"  >
                                        @endif
                                        Lecture Hall
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        @if($userRequest->ResourceType=='Lab')
                                            <input type="radio" name="ResourceTypeEdit" id="ResourceTypeEdit" value="Lab" checked >
                                        @else
                                            <input type="radio" name="ResourceTypeEdit" id="ResourceTypeEdit" value="Lab"  >
                                        @endif
                                        Lab
                                    </label>
                                </div>
                            </div>

                            <div  class="form-group">
                                <label>Start Time</label>
                                <input  type="text" class="form-control"  id="selectTimeSpecialST" name="selectTimeSpecialST">

                                <script>


                                        $('input[name="selectTimeSpecialST"]').timepicker({
                                            change: function (){

                                                start_time = $('#selectTimeSpecialST').val();
                                                end_time = $('#selectTimeSpecialEN').val();
                                                var special = start_time + " - " + end_time;


//                                                $('#selecttimeEdit').empty().append($('<option>',
//                                                        {
//                                                            value: special,
//                                                            text: special
//                                                        }));
                                                $('#selecttimeEdit').val(special);
                                            },
                                            timeFormat: 'H:mm',
                                            interval:'30',
                                            minTime: '8:00',
                                            maxTime: '18:30',
                                            defaultTime:'8:00',
                                            scrollbar:'true',
                                            disableTextInput: 'true'
                                        });

                                </script>

                                <label>End Time</label>
                                <input  type="text" class="form-control"  id="selectTimeSpecialEN" name="selectTimeSpecialEN">

                                    <script>

                                        $('input[name="selectTimeSpecialEN"]').timepicker({
                                            change: function (){

                                                start_time = $('#selectTimeSpecialST').val();
                                                end_time = $('#selectTimeSpecialEN').val();
                                                var special = start_time + " - " + end_time;


//                                                $('#selecttimeEdit').empty().append($('<option>',
//                                                        {
//                                                            value: special,
//                                                            text: special
//                                                        }));
                                                $('#selecttimeEdit').val(special);
                                            },
                                            timeFormat: 'H:mm' ,
                                            interval:'30',
                                            minTime: '8:30',
                                            maxTime: '18:30',
                                            defaultTime:'8:30',
                                            scrollbar:'true',
                                            disableTextInput: 'true'

                                        });


                                </script>
                            </div>

                            <!-- special event -->
                            <div class="form-group">
                                <label>Special event details</label>
                                <input class="form-control" type="text" name="specialEventEdit" id="specialEventEdit" value="{{$userRequest->specialEvent}}">

                            </div>

                            <!-- special event capacity -->
                            <div class="form-group">
                                <label>Capacity required</label>
                                <input class="form-control" type="text" name="capacityEdit" id="capacityEdit" value="{{$userRequest->capacity}}">

                            </div>


                            <!-- select Time Slot  -->
                            <div class="form-group">

                                <label>Time Slot</label><br>
                                <p>Previous Time Slot: {{$userRequest->timeSlot}}</p>
                                <input type="text" class="form-control" name="selecttimeEdit" id="selecttimeEdit" value="{{$userRequest->timeSlot}}" readonly="readonly">
                                </input>
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
                                    $.notify("Your request has been successfully Edited", "success",
                                            {position:"center"}
                                    );
                                }

                                function ValidateCapacity()
                                {

                                        var capacity=$('#capacityEdit').val();
                                        var details=$('#specialEventEdit').val();

                                        //var capacity=$("input[name=capacity]").attr("value");
                                        if(details == "")
                                        {
                                            //set the display value to empty on the style so that the div will be displayed
                                            $("#errordisplay").css('display','');
                                            $('#errordisplay').text("Special Event Details cannot be empty");
                                            return false;
                                        }
                                        if(capacity === "")
                                        {
                                            $("#errordisplay").css('display','');
                                            $('#errordisplay').text("Capacity cannot be empty");
                                            return false;
                                        }

                                    //submit the form is there are no errors
                                    $('#editrequesFormSpecial').submit();
                                    Success();

                                    }


                            </script>

                            <button id="submitbtn" type="submit " class="btn btn-primary pull-right" onclick="return ValidateCapacity()">Submit</button>


                    </form>
                </div>
                <!-- /.box-body -->


            </div>
        </div>
    </div>
    </div>
@endsection