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
                                            showDropdowns: true,
                                            locale: {
                                                format: 'YYYY-MM-DD-ddd'
                                            },
                                        },
                                        function(start, end, label) {
                                            var years = moment().diff(start, 'years');

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

                      <!-- select Time Slot  -->
                      <div class="form-group">
                          <label>Time Slot</label>
                          <select class="form-control" name="selecttime" id="selecttime">
                              <option value="">Please Select</option>
                              <option value="8.30-10.30">8.30-10.30</option>
                              <option value="10.30-12.30">10.30-12.30</option>
                              <option value="12.30-1.30">12.30-1.30</option>
                              <option value="1.30-3.30">1.30-3.30</option>
                              <option value="3.30-5.30">3.30-5.30</option>
                          </select>
                      </div>


                      <script>
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

                                                                  .attr("value",value)

                                                                  .text(value));
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

                          //load halls
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

                                                                  .attr("value",value)

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
                      <option value="">Please select</option>
                  </select>
                </div>
                  
                  <!-- select Subject -->
                <div class="form-group">
                  <label>Subject</label>
                  <select class="form-control" name="selectsub">
                    @foreach($subjects as $subject)
                    <option value="{{$subject->id}}"> {{$subject->subName}}</option>
                    @endforeach
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


                      <button type="submit " class="btn btn-primary pull-right">Submit</button>
              </form>
            </div>
            <!-- /.box-body -->
  
           
          </div>
        </div>
    </div>
</div>
@endsection