@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>
       Request Form
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Home</li>
        <li class="active">User Request</li>
        <li class="active">Add Academic/Special Event Requests</li>
    </ol>
</section>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col col-sm-7">
       <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Request Timeslot</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <form role="form" method="POST" action="/userRequest/requestForm/add" name="requestForm" id="requestForm">
                  
                  {!! csrf_field() !!}


                <!--Date-->
                <div class="form-group">
                    <label>Date:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                    <input type="text" class="form-control pull-right" id="selectdate" name="selectdate">
                        <script type="text/javascript">

                            $(function() {
                                $('input[name="selectdate"]').daterangepicker({
                                            singleDatePicker: true,
                                            minDate:new Date(),
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

                      {{--Select time slot type--}}
                      <div class="form-group">
                          <label>Time Slot Type</label>
                          <div class="radio">
                              <label>
                                  <input type="radio" name="SlotType" id="SlotType" value="1"  onclick="setSelect('1')" >
                                  One hour Slot
                              </label>
                          </div>
                          <div class="radio">
                              <label>
                                  <input type="radio" name="SlotType" id="SlotType" value="2"  onclick="setSelect('2')" checked>
                                  Two Hour Slot
                              </label>
                          </div>
                          <div class="radio">
                              <label>
                                  <input type="radio" name="SlotType" id="SlotType" value="3"  onclick="setSelect('3')" >
                                  Special events
                              </label>
                          </div>

                      </div>
                      <!--Resource Type-->
                      <div class="form-group">
                          <label>Resource Type</label>
                          <div class="radio">
                              <label>
                                  <input type="radio" name="ResourceType" id="ResourceType" value="LectureHall" checked >
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
                      <div  class="form-group">
                          <label>Start Time</label>
                          <input  type="text" class="form-control"  id="selectTimeSpecialST" name="selectTimeSpecialST">

                          <script>
                              $(document).ready(function(){

                                  $('input[name="selectTimeSpecialST"]').timepicker({
                                      change: function () {

                                          start_time = $('#selectTimeSpecialST').val();
                                          end_time = $('#selectTimeSpecialEN').val();
                                          var special = start_time + " - " + end_time;


//                                          $('#selecttime').empty().append($('<option>',
//                                                  {
//                                                      value: special,
//                                                      text: special
//                                                  }));
                                          $('#selecttimeforSp').val(special);
                                      },
                                      timeFormat: 'H:mm',
                                      interval:'30',
                                      minTime: '8:00',
                                      maxTime: '18:30',
                                      defaultTime:'8:00',
                                      scrollbar:'true',
                                      disableTextInput: 'true'
                                  });
                              });
                          </script>

                          <label>End Time</label>
                          <input type="text" class="form-control"  id="selectTimeSpecialEN" name="selectTimeSpecialEN" >

                          <script>
                              $(document).ready(function(){
                              $('input[name="selectTimeSpecialEN"]').timepicker({
                                  change: function (){

                                      start_time = $('#selectTimeSpecialST').val();
                                      end_time = $('#selectTimeSpecialEN').val();
                                      var special = start_time + " - " + end_time;


//                                      $('#selecttime').empty().append($('<option>',
//                                              {
//                                                  value: special,
//                                                  text: special
//                                              }));
                                      $('#selecttimeforSp').val(special);
                                  },
                                  timeFormat: 'H:mm' ,
                                  interval:'30',
                                  minTime: '8:30',
                                  maxTime: '18:30',
                                  defaultTime:'8:30',
                                  scrollbar:'true',
                                  disableTextInput: 'true'

                                    });

                              });

                          </script>
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
                              if (v=='1'){
                                  $("#selecttimeforSp").css('display','none');
                                  $("#selecttimeforSp").prop('disabled', true);
                                  document.getElementById("selectTimeSpecialST").disabled = true;
                                  document.getElementById("selectTimeSpecialEN").disabled = true;
                                  document.getElementById("specialEvent").disabled = true;
                                  document.getElementById("capacity").disabled = true;
                                  document.getElementById("selectsub").disabled = false;
                                  document.getElementById("selectyear").disabled = false;
                                  document.getElementById("selectbatch").disabled = false;
                                  document.getElementById("selecttime").disabled = false;
                                  a = OneHourSet;
                                  for (var i = 0; i < a.length; ++i) {
                                      var option = document.createElement("option");
                                      option.text = a[i];
                                      x.add(option);
                                  }
                              } else if (v=='2'){
                                  $("#selecttimeforSp").css('display','none');
                                  $("#selecttimeforSp").prop('disabled', true);
                                  document.getElementById("selectTimeSpecialST").disabled = true;
                                  document.getElementById("selectTimeSpecialEN").disabled = true;
                                  document.getElementById("specialEvent").disabled = true;
                                  document.getElementById("capacity").disabled = true;
                                  document.getElementById("selectsub").disabled = false;
                                  document.getElementById("selectyear").disabled = false;
                                  document.getElementById("selectbatch").disabled = false;
                                  document.getElementById("selecttime").disabled = false;
                                  a = TwoHourSet
                                  for (var i = 0; i < a.length; ++i) {
                                      var option = document.createElement("option");
                                      option.text = a[i];
                                      x.add(option);
                                  }
                              }
                              else if (v=='3'){

                                  $("#selecttimeforSp").css('display','');
                                  $("#selecttimeforSp").prop('disabled', false);
                                  document.getElementById("selectTimeSpecialST").disabled = false;
                                  document.getElementById("selectTimeSpecialEN").disabled = false;
                                  document.getElementById("specialEvent").disabled = false;
                                  document.getElementById("capacity").disabled = false;
                                  document.getElementById("selectsub").disabled = true;
                                  document.getElementById("selectyear").disabled = true;
                                  document.getElementById("selectbatch").disabled = true;
                                  document.getElementById("selecttime").disabled = true;
                              }


                          }
                          function load() {
                              setSelect('2');
                          }
                          window.onload = load;
                      </script>

                      <!-- special event -->
                      <div class="form-group">
                          <label>Special event details</label>
                          <input class="form-control" type="text" name="specialEvent" id="specialEvent">

                      </div>

                      <!-- special event capacity -->
                      <div class="form-group">
                          <label>Capacity required</label>
                          <input class="form-control" type="text" name="capacity" id="capacity">

                      </div>

                      {{--<!-- select Time Slot  -->--}}
                      {{--<div class="form-group">--}}
                          {{--<label>Time Slot</label>--}}
                         {{----}}

                          {{--</input>--}}
                      {{--</div>--}}

                      <!-- select Time Slot  -->
                      <div class="form-group">
                          <label>Time Slot</label>
                          <select class="form-control" name="selecttime" id="selecttime">

                          </select>
                          <input type="text" class="form-control" name="selecttime" id="selecttimeforSp" style="display:none" readonly>
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

                      <div class="flash-message" id="errordisplay">
                          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                              @if(Session::has('alert-' . $msg))

                                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                              @endif
                          @endforeach
                      </div>
                      <button id="submitbtn" type="button" class="btn btn-primary pull-right" onclick="return ValidateCapacity()" >Submit</button>



              </form>
            </div>
            <!-- /.box-body -->
  
           
          </div>
        </div>
    </div>


<script>
        function Success()
        {
            $.notify("Your request has been successfully logged", "success",
                    {position:"center"}
            );
        }

        function ValidateCapacity()
        {

            var radioBtn = $("input[name=SlotType]:checked").attr("value");
            //console.log(radioBtn);
            if(radioBtn==3)
            {
                var capacity=$('#capacity').val();
                var details=$('#specialEvent').val();

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
                else if(($.isNumeric(capacity))===false)
                {
                    $("#errordisplay").css('display','');
                    $('#errordisplay').text("Capacity should be a number");
                    return false;
                }




            }

            //submit the form if there are no errors
            $('#requestForm').submit()
                    //Success();



        }
        // ValidateCapacity();
    </script>

</div>
@endsection