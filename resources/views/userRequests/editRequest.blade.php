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
              <form role="form" method="POST" action="/userRequest/updateUserRequest/{{$userRequest->id}}" >
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
                           <select class="form-control" name="selecttimeEdit">
                               @if ($userRequest->requestDate === "8.30-10.30")
                                   <option value="8.30-10.30" selected="selected">8.30-10.30</option>
                               @elseif ($userRequest->requestDate === "10.30-12.30")
                                   <option value="10.30-12.30" selected="selected">10.30-12.30</option>
                               @elseif ($userRequest->requestDate === "12.30-1.30")
                                   <option value="12.30-1.30" selected="selected">12.30-1.30</option>
                               @elseif ($userRequest->requestDate === "1.30-3.30")
                                   <option value="1.30-3.30" selected="selected">1.30-3.30</option>
                               @elseif ($userRequest->requestDate === "3.30-5.30")
                                   <option value="3.30-5.30" selected="selected">3.30-5.30</option>
                               @endif
                                   <option value="8.30-10.30">8.30-10.30</option>
                                   <option value="10.30-12.30">10.30-12.30</option>
                                   <option value="12.30-1.30">12.30-1.30</option>
                                   <option value="1.30-3.30">1.30-3.30</option>
                                   <option value="3.30-5.30">3.30-5.30</option>
                           </select>
                       </div>
                  
                  
                <!-- select Year  -->
                <div class="form-group">
                  <label>Year</label>
                  <select class="form-control" name="selectyearEdit">
                    @if ($userRequest->year === "Y1")
                        <option value="Y1" selected="selected"> 1</option>
                     @elseif ($userRequest->year === "Y2")
                        <option value="Y3" selected="selected"> 2</option>
                       @elseif ($userRequest->year === "Y3")
                        <option value="Y3" selected="selected"> 3</option>
                       @elseif ($userRequest->year === "Y4")
                        <option value="Y4" selected="selected"> 4</option>
                      @endif
                    <option value="Y1" > 1</option>
                    <option value="Y2"> 2</option>
                    <option value="Y3"> 3</option>
                    <option value="Y4"> 4</option>

                  </select>
                </div>
                  
                  <!-- select Batch -->
                <div class="form-group">
                  <label>Batch</label>
                  <select class="form-control" name="selectbatchEdit" >
                    @foreach($batches as $batch)
                              <option  value="{{$batch->id}}"  @if(($userRequest->batchNo) == ($batch->id)) selected @endif> {{ $batch->batchNo }}</option>
                    @endforeach

                  </select>

                </div>
                  
                  <!-- select Subject -->
                <div class="form-group">
                  <label>Subject</label>
                  <select class="form-control" name="selectsubEdit">
                    @foreach($subjects as $subject)
                              <option  value="{{$subject->id}}"  @if(($userRequest->subjectCode) == ($subject->id)) selected @endif> {{ $subject->subName }}</option>
                    @endforeach
                  </select>
                </div>
                  
                   <!-- select Hall -->
                <div class="form-group">
                  <label>Lecture Hall/Lab</label>
                  <select class="form-control" name="selectresEdit">
                    @foreach($resources as $resource)
                             <option  value="{{$resource->id}}"  @if ($userRequest->resourceID === $resource->id) selected @endif> {{$resource->hallNo }}</option>
                    @endforeach

                  </select>
                </div>

                  <button type="submit " class="btn btn-primary pull-right">Submit</button>
              </form>
            </div>
            <!-- /.box-body -->
  
           
          </div>
        </div>
    </div>
</div>
@endsection