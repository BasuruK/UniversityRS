@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Edit Semester Request Form
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
                        <form role="form" method="POST" action="/userRequest/UpdateSemesterRequest/{{$userRequest->id}}" name="semesterReqEdit">
                        {{method_field('PATCH')}}
                        {!! csrf_field() !!}

                        <!--Date-->
                            <div class="form-group">
                                <label>Day:</label>
                                <select class="form-control" name="selectdateEdit" id="selectdateEdit">
                                    @if($userRequest->requestDate=='monday')
                                    <option  value="monday" selected="selected">Monday</option >
                                    @elseif($userRequest->requestDate=="tuesday")
                                    <option  value="tuesday" selected="selected">Tuesday</option>
                                    @elseif($userRequest->requestDate=="wednesday")
                                    <option  value="wednesday" selected="selected">Wednesday</option>
                                    @elseif($userRequest->requestDate=="thursday")
                                    <option  value="thursday" selected="selected">Thursday</option>
                                    @elseif($userRequest->requestDate=="friday")
                                    <option  value="friday" selected="selected">Friday</option>
                                    @elseif($userRequest->requestDate=="saturday")
                                    <option value="saturday" selected="selected">Saturday</option>
                                    @elseif($userRequest->requestDate=="sunday")
                                    <option value="sunday" selected="selected">Sunday</option>
                                    @endif
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

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevhall" id="prevhall" value="{{$userRequest->resourceID}}">
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevbatch" id="prevbatch" value="{{$userRequest->batchNo}}">
                            </div>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevsub" id="prevsub" value="{{$userRequest->subjectCode}}">
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
                                        @if($userRequest->timeslotType=='1')
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="1"  onclick="setSelect('1')" checked>
                                        @else
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="1"  onclick="setSelect('1')">
                                        @endif
                                        One hour Slot
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        @if($userRequest->timeslotType=='2')
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="2"  onclick="setSelect('2')" checked>
                                        @else
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="2"  onclick="setSelect('2')">
                                        @endif
                                        Two Hour Slot
                                    </label>
                                </div>
                            </div >

                            <!--Resource Type-->
                            <div class="form-group">
                                <label>Resource Type</label>
                                <div class="radio">
                                    <label>
                                        @if($userRequest->ResourceType=='Lecture Hall')
                                            <input type="radio" name="ResourceTypeEdit" id="ResourceTypeEdit" value="Lecture Hall" checked >
                                        @else
                                            <input type="radio" name="ResourceTypeEdit" id="ResourceTypeEdit" value="Lecture Hall"  >
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

                            <div class="form-group">
                                <label>Semester</label><br>
                                <input type="text" class="form-control" id="semesterselectEdit" name="semesterselectEdit" value="{{$userRequest->semester}}">
                            </div>


                            <script>
                                /**
                                 * Dynamically populate the select options for timeslots
                                 */
                                var OneHourSet=['8.30-9.30','9.30-10.30','10.30-11.30','11.30-12.30','12.30-14.30','14.30-15.30','15.30-16.30','16.30-17.30','17.30-18.30'];
                                var TwoHourSet=['8.30-10.30','10.30-12.30','14.30-16.30','16.30-18.30'];


                                function setSelect(v) {
                                    var x = document.getElementById("selecttimeEdit");
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
                                            option.selected='selected';
                                            x.add(option);
                                        }
                                        else
                                        {
                                            var option = document.createElement("option");
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
                                <select class="form-control" name="selecttimeEdit" id="selecttimeEdit">

                                </select>
                            </div>


                            <!-- select Year  -->
                            <div class="form-group">
                                <label>Year</label>
                                <select class="form-control" name="selectyearEdit" id="selectyearEdit">
                                    @if ($userRequest->year === "1")
                                        <option value="1" selected="selected">1</option>
                                    @elseif ($userRequest->year === "2")
                                        <option value="2" selected="selected">2</option>
                                    @elseif ($userRequest->year === "3")
                                        <option value="3" selected="selected">3</option>
                                    @elseif ($userRequest->year === "4")
                                        <option value="4" selected="selected">4</option>
                                    @endif
                                    <option value="1" > 1</option>
                                    <option value="2"> 2</option>
                                    <option value="3"> 3</option>
                                    <option value="4"> 4</option>

                                </select>
                            </div>


                            <script>
                                /**
                                 * Dynamically populate the select options for batches
                                 */
                                $(document).ready(function()
                                {
                                    $.get("{{ url('/userRequest/requestForm/loadBatches')}}", {option: $('#selectyearEdit').val()},

                                            function(data) {

                                                var selectedbatch = $('#selectbatchEdit');

                                                selectedbatch.empty();

                                                $.each(data, function(key, value) {

                                                    if(key==$('#prevbatch').val())
                                                    {
                                                        selectedbatch

                                                                .append($("<option selected='selected'></option >")

                                                                        .attr("value",key)

                                                                        .text(value));
                                                    }
                                                    else
                                                    {
                                                        selectedbatch

                                                                .append($("<option></option>")

                                                                        .attr("value",key)

                                                                        .text(value));
                                                    }
                                                });

                                            });
                                    $('#selectyearEdit').change(function(){

                                        $.get("{{ url('/userRequest/requestForm/loadBatches')}}", {option: $(this).val()},

                                                function(data) {

                                                    var selectedbatch = $('#selectbatchEdit');

                                                    selectedbatch.empty();

                                                    $.each(data, function(key, value) {

                                                        if(key==$('#prevbatch').val())
                                                        {
                                                            selectedbatch

                                                                    .append($("<option selected='selected'></option >")

                                                                            .attr("value",key)

                                                                            .text(value));
                                                        }
                                                        else
                                                        {
                                                            selectedbatch

                                                                    .append($("<option></option>")

                                                                            .attr("value",key)

                                                                            .text(value));
                                                        }
                                                    });

                                                });

                                    });

                                });

                            </script>

                            <!-- select Batch -->
                            <div class="form-group">
                                <label>Batch</label><br>
                                <select class="form-control" name="selectbatchEdit" id="selectbatchEdit">
                                </select>
                            </div>
                            <script>
                                /**
                                 * Dynamically populate the select options for subjects
                                 */
                                $(document).ready(function()
                                {
                                    $.get("{{ url('/userRequest/requestForm/loadSubjects')}}", {option: $('#selectyearEdit').val()},

                                            function(data) {

                                                var selectedSub = $('#selectsubEdit');

                                                selectedSub.empty();

                                                $.each(data, function(key, value) {

                                                    if(key==$('#prevsub').val())
                                                    {
                                                        selectedSub

                                                                .append($("<option selected='selected'></option>")
                                                                        .attr("value",key)
                                                                        .text(value));
                                                    }
                                                    else
                                                    {
                                                        selectedSub

                                                                .append($("<option></option>")
                                                                        .attr("value",key)
                                                                        .text(value));
                                                    }
                                                });

                                            });


                                    $('#selectyearEdit').change(function(){

                                        $.get("{{ url('/userRequest/requestForm/loadSubjects')}}", {option: $(this).val()},

                                                function(data) {

                                                    var selectedSub = $('#selectsubEdit');

                                                    selectedSub.empty();

                                                    $.each(data, function(key, value) {

                                                        if(key==$('#prevsub').val())
                                                        {
                                                            selectedSub

                                                                    .append($("<option selected='selected'></option>")
                                                                            .attr("value",key)
                                                                            .text(value));
                                                        }
                                                        else
                                                        {
                                                            selectedSub

                                                                    .append($("<option></option>")
                                                                            .attr("value",key)
                                                                            .text(value));
                                                        }
                                                    });

                                                });

                                    });

                                });
                            </script>

                            <!-- select Subject -->
                            <div class="form-group">
                                <label>Subject</label>
                                <select class="form-control" name="selectsubEdit" id="selectsubEdit">
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
                                    $.notify("Your request has been successfully Edited", "success",
                                            {position:"center"}
                                    );
                                }
                                function ValidateSemester()
                                {
                                    //console.log(radioBtn);

                                    var semester=$('#semesterselectEdit').val();



                                    if(semester == "")
                                    {
                                        //set the display value to empty on the style so that the div will be displayed
                                        $("#errordisplay").css('display','');
                                        $('#errordisplay').text("Semester cannot be empty");
                                        return false;
                                    }
                                    else if(semester>2)
                                    {
                                        $("#errordisplay").css('display','');
                                        $('#errordisplay').text("Semester value must be either 1 or 2");
                                        return false;
                                    }

                                    //submit the form is there are no errors
                                    $('#semesterReqEdit').submit();
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