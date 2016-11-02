@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Edit Formal Request
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Formal Request</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="container-fluid">

        <script>
            /**
             * Dynamically populate the
             * select options for available resources
             */
            $(document).ready(function()
            {

                $.get("{{ url('/adminRequest/requestForm/loadHallsDate_Formal')}}", {option: $('#selectdateEdit').val(),option2: $('#prevtimeslot').val(),option3: $('#reqResourceType').val(), option4: $('#prevbatch').val()},

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
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" method="POST" action="/adminRequest/update/{{$admin_request->id}}" name="semesterReqEdit">
                        {{method_field('PATCH')}}
                        {!! csrf_field() !!}



                        <!--Date-->
                            <div class="form-group">
                                <label>Day</label><br>
                                <p>{{ $admin_request->requestDate }}</p>
                            </div>

                            <script>

                                $(document).ready(function() {

                                    $.get("{{ url('/adminRequest/requestForm/loadHallsDate_Formal')}}", {
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

                                });
                            </script>

                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevbatch" id="prevbatch" value="{{$admin_request->batchNo}}">
                            </div>
                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevsub" id="prevsub" value="{{$admin_request->subjectCode}}">
                            </div>
                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="prevtimeslot" id="prevtimeslot" value="{{$admin_request->timeSlot}}">
                            </div>
                            <div class="form-group"  hidden="">
                                <input type="text"  class="form-control"  name="reqResourceType" id="reqResourceType" value="{{$admin_request->ResourceType}}">
                            </div>



                            {{--Select time slot type--}}
                            <div class="form-group">
                                <label>Time Slot Type</label>
                                <div class="radio">
                                    <label>
                                        @if($admin_request->timeslotType=='1')
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="1"  onclick="setSelect('1')" checked>
                                        @else
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="1"  onclick="setSelect('1')" disabled>
                                        @endif
                                        One hour Slot
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        @if($admin_request->timeslotType=='2')
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="2"  onclick="setSelect('2')" checked>
                                        @else
                                            <input type="radio" name="SlotTypeEdit" id="SlotTypeEdit" value="2"  onclick="setSelect('2')" disabled>
                                        @endif
                                        Two Hour Slot
                                    </label>
                                </div>
                            </div >

                            <!-- select Time Slot  -->
                            <div class="form-group">
                                <label>Time Slot</label><br>
                                <p>{{ $admin_request->timeSlot }}</p>
                            </div>

                            <script>

                                $('#selectTimeEdit').change(function(){



                                    $.get("{{ url('/adminRequest/requestForm/loadHallsTime_Formal')}}", {option: $(this).val(),option2: $('#selectdateEdit').val(),option3: $('#reqResourceType').val(),option4: $('#prevbatch').val()},

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
                                <p>{{ $admin_request->ResourceType }}</p>
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

                            <div class="form-group">
                                <label>Semester</label><br>
                                <p>{{ $admin_request->semester }}</p>
                            </div>

                            <div class="form-group">
                                <label>Year</label></br>
                                <p>{{ $admin_request->year }}</p>
                            </div>



                            <!-- select Batch -->
                            <div class="form-group">
                                <label>Batch</label><br>
                                <p>{{ $batch->batchNo }}</p>
                            </div>



                            <!-- select Subject -->
                            <div class="form-group">
                                <label>Subject</label><br>
                                <p>{{ $selectedSub->subName }}</p>
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
                            <a href="/adminRequest" class="btn btn-warning">Cancel</a>

                            <button id="submitbtn" type="submit " class="btn btn-primary pull-right" >Submit</button>
                        </form>
                    </div>
                    <!-- /.box-body -->


                </div>
            </div>
        </div>



    </div>
@endsection