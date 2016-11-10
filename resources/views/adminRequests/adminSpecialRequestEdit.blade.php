@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Edit Special Request
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">special Request Edit</li>
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
                        <form role="form" method="POST" action="/adminRequest/specialRequestUpdate/{{$adminSpecialRequest->id}}"  name="specialReqEdit">
                        {{method_field('PATCH')}}
                        {!! csrf_field() !!}

                        <!--Date-->
                            <div class="form-group">
                                <label>Date:</label>

                                <div class="input-group date">
                                    <p>{{$adminSpecialRequest->requestDate}}</p>
                                </div>
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="userID" value="{{Auth::user()->id}}">
                            </div>
                            <div class="form-group" hidden="">
                                <input type="text" hidden="" class="form-control"  name="staffID" value="{{Auth::user()->staff_id}}">
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevtimeslot" id="prevtimeslot" value="{{$adminSpecialRequest->timeSlot}}">
                            </div>
                            <div class="form-group"  hidden=""> >
                                <input type="text"  class="form-control"  name="prevRtype" id="prevRtype" value="{{$adminSpecialRequest->ResourceType}}">
                            </div>

                            {{--Select time slot type--}}
                            <div class="form-group">
                                <label>Time Slot Type</label>

                                <div class="radio">
                                    <label>
                                        @if($adminSpecialRequest->timeslotType=='3')
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="3"  onclick="setSelect('3')" checked>
                                        @else
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="3"  onclick="setSelect('3')" >
                                        @endif
                                        Special events
                                    </label>
                                </div>

                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="reqResourceType" id="reqResourceType" value="{{$adminSpecialRequest->ResourceType}}">
                            </div>

                            <div class="form-group">
                                <label>Resource Type</label><br>
                                <p>{{ $adminSpecialRequest->ResourceType }}</p>
                            </div>
                            <!-- select Resource -->
                            <div class="form-group">
                                <label>Resource</label><br>
                                <select class="form-control" name="selectResources" id="selectResources">
                                    @foreach($allAvailableHalls as $availableHalls)
                                        <option value="{{$availableHalls}}">{{$availableHalls}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- special event -->
                            <div class="form-group">
                                <label>Special event details</label>
                                <p>{{$adminSpecialRequest->specialEvent}}</p>

                            </div>

                            <!-- special event capacity -->
                            <div class="form-group">
                                <label>Capacity required</label>
                                <p>{{$adminSpecialRequest->capacity}}</p>

                            </div>


                            <!-- select Time Slot  -->
                            <div class="form-group">

                                <label>Time Slot</label><br>
                                <input type="text" class="form-control" name="selecttimeEdit" id="selecttimeEdit" value="{{$adminSpecialRequest->timeSlot}}" readonly="readonly">
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