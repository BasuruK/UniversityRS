@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>
       Request Form
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
              <h3 class="box-title">Request Timeslot</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="POST" action="/userRequest/requestForm/add" >
                  
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
                          <div class="radio">
                              <label>
                                  <input type="radio" name="SlotType" id="SlotType3" value="3"  onclick="setSelect('other')" >
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
                          /**
                           * Dynamically populate the select options for timeslots
                           */
                          var OneHourSet=['Please Select','8.30-9.30','9.30-10.30','10.30-11.30','11.30-12.30','12.30-14.30','14.30-15.30','15.30-16.30','16.30-17.30','17.30-18.30'];
                          var TwoHourSet=['Please Select','8.30-10.30','10.30-12.30','14.30-16.30','16.30-18.30'];


                          function setSelect(v) {
                              var x = document.getElementById("selecttime");
                              for (i = 0; i < x.length; ) {
                                  x.remove(x.length -1);
                              }
                              var a;
                              if (v=='1hr'){
                                  document.getElementById("selectTimeSpecialST").disabled = true;
                                  document.getElementById("selectTimeSpecialEN").disabled = true;
                                  document.getElementById("selectsub").disabled = false;
                                  a = OneHourSet;
                              } else if (v=='2hr'){
                                  document.getElementById("selectTimeSpecialST").disabled = true;
                                  document.getElementById("selectTimeSpecialEN").disabled = true;
                                  document.getElementById("selectsub").disabled = false;
                                  a = TwoHourSet
                              }
                              else if (v=='other'){
                                  document.getElementById("selectTimeSpecialST").disabled = false;
                                  document.getElementById("selectTimeSpecialEN").disabled = false;
                                  document.getElementById("selectsub").disabled = true;
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


                        <script>
                                    $('#selectTimeSpecialST').change(function ()
                                    {
                                        start_time=$('#selectTimeSpecialST').val();
                                        end_time=$('#selectTimeSpecialEN').val();
                                        var special=start_time+ "-" +end_time;


                                        $('#selecttime').empty().append($('<option>',
                                                {
                                                    value: special,
                                                    text : special
                                                }));
                                        $('#selecttime').val(special);
                                        $.get("{{ url('/userRequest/requestForm/loadHallsDate')}}", {option: $('#selectdate').val(),option2: $('#selecttime').val()},

                                                function(data) {

                                                    var availableHalls = $('#selectres');

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

                      <script>
                          $('#selectTimeSpecialEN').change(function ()
                          {

                              start_time=$('#selectTimeSpecialST').val();
                              end_time=$('#selectTimeSpecialEN').val();
                              special=start_time+ "-" +end_time;


                              $('#selecttime').empty().append($('<option>',
                                      {
                                          value: special,
                                          text : special
                                      }));

                              $('#selecttime').val(special);
                              $.get("{{ url('/userRequest/requestForm/loadHallsDate')}}", {option: $('#selectdate').val(),option2: $('#selecttime').val()},

                                      function(data) {

                                          var availableHalls = $('#selectres');

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

                      <!-- select Time Slot  -->
                      <div class="form-group">
                          <label>Time Slot</label>
                          <select class="form-control" name="selecttime" id="selecttime">

                          </select>
                      </div>


                      <script>
                          /**
                           * Dynamically populate the select options for resources
                           */
                          $(document).ready(function()
                          {
                              $('#selectdate').change(function(){



                                  $.get("{{ url('/userRequest/requestForm/loadHallsDate')}}", {option: $(this).val(),option2: $('#selecttime').val()},

                                          function(data) {

                                              var availableHalls = $('#selectres');

                                              availableHalls.empty();

                                              $.each(data, function(key, value) {

                                                  availableHalls

                                                          .append($("<option></option>")

                                                                  .attr("value",key)

                                                                  .text(key+value));
                                              });

                                          });

                              });

                          });
                      </script>

                <!-- select Year  -->
                <div class="form-group">
                  <label>Year</label>

                  <select class="form-control" name="selectyear" id="selectyear">
                      <option value="">Please select</option>
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

                          /**
                           * Dynamically populate the select options for resources
                           */
                          $(document).ready(function()
                          {
                              $('#selecttime').change(function(){

                                  $.get("{{ url('/userRequest/requestForm/loadHallsTime')}}", {option: $(this).val(),option2:$('#selectdate').val() },

                                          function(data) {

                                              var availableHalls = $('#selectres');

                                              availableHalls.empty();

                                              $.each(data, function(key, value) {

                                                  availableHalls

                                                          .append($("<option></option>")

                                                                  .attr("value",key)

                                                                  .text(key+value));
                                              });

                                          });

                              });

                          });

                      </script>

                  <!-- select Batch -->
                <div class="form-group">
                  <label>Batch</label>
                  <select class="form-control" name="selectbatch" id="selectbatch">
                      <option value="">Please select</option>
                  </select>
                </div>
                      <script>
                          /**
                           * Dynamically populate the select options for subjects
                           */
                          $(document).ready(function()
                          {
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
                      <option value="">Please select</option>
                  </select>
                </div>


                   <!-- select Hall -->
                <div class="form-group">
                  <label>Lecture Hall/Lab</label>

                  <select class="form-control" name="selectres" id="selectres">
                      <option value="">Please select</option>
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
        $notify("Your request has been successfully logged", "success",
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