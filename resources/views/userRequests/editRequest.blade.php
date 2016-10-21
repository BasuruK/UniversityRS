@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>
       Edit Request
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
                           <input type="text"  class="form-control"  name="prevbatch" id="prevbatch" value="{{$userRequest->batchNo}}">
                       </div>

                       <div class="form-group"  hidden="">
                           <input type="text"  class="form-control"  name="prevsub" id="prevsub" value="{{$userRequest->subjectCode}}">
                       </div>
                       <div class="form-group"  hidden=""> >
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
                       </div>


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


                       <script>
                           /**
                            * Dynamically populate the select options for timeslots
                            */
                           var OneHourSet=['8.30 - 9.30','9.30 - 10.30','10.30 - 11.30','11.30 - 12.30','12.30 - 14.30','14.30 - 15.30','15.30 - 16.30','16.30 - 17.30','17.30 - 18.30','18.30 - 19.30','19.30 - 20.30'];
                           var TwoHourSet=['8.30 - 10.30','10.30 - 12.30','14.30 - 16.30','16.30 - 18.30','18.30 - 20.30'];


                           function setSelect(v) {
                               var x = document.getElementById("selecttimeEdit");
                               for (i = 0; i < x.length; ) {
                                   x.remove(x.length -1);
                               }
                               var a;
                               if (v=='1'){
                                   a = OneHourSet;
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
                               else if (v=='2'){
                                   a = TwoHourSet;
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

                           }
                           function load() {
                               var currentType=document.editrequesForm.SlotTypeEdit.value;

                              setSelect(currentType);
                           }
                           window.onload = load;
                       </script>

                       <!-- select Time Slot  -->
                       <div class="form-group">

                           <label>Time Slot</label><br>
                           <p>Previous Time Slot: {{$userRequest->timeSlot}}</p>
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

                           /**
                            * Dynamically populate the select options for batches
                            */
                           $(document).ready(function()
                           {
                               $('#selectyearEdit').change(function(){

                                   $.get("{{ url('/userRequest/requestForm/loadBatches')}}", {option: $(this).val()},

                                           function(data) {

                                               var selectedbatch = $('#selectbatchEdit');

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

                       <!-- select Subject -->
                       <div class="form-group">

                           <label>Subject</label><br>
                           <p>Previous Subject: {{$selectedSub->subName}}</p>
                           <select class="form-control" name="selectsubEdit" id="selectsubEdit">
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
                               $.notify("Your request has been successfully Edited", "success",
                                       {position:"center"}
                               );
                           }
                       </script>

                       <button id="submitbtn" type="submit " class="btn btn-primary pull-right" onclick="return Success()">Submit</button>


              </form>
            </div>
            <!-- /.box-body -->
  
           
          </div>
        </div>
    </div>
</div>
@endsection