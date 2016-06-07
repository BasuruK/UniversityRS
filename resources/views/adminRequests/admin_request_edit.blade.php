@extends('layouts.Main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col-sm-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Request</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" method="POST" action="/adminRequest/update/{{$admin_request->id}}" >
                        {{method_field('PATCH')}}
                        {!! csrf_field() !!}

                        <!--Date-->
                            <div class="form-group">
                                <label>Date:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="selectdateEdit" value="{{$admin_request->requestDate}}">
                                    <script type="text/javascript">
                                        $(function() {
                                            $('input[name="selectdate"]').daterangepicker({
                                                        singleDatePicker: true,
                                                        showDropdowns: true,
                                                        locale: {
                                                            format: 'YYYY-MM-DD-ddd'
                                                        }
                                                    },
                                                    function(start,end,label){
                                                        var years = moment().diff(start,'years');
                                                    }
                                            );
                                        });
                                    </script>
                                </div>
                            </div>

                            <!-- time slot -->
                            <div class="form-group">
                                <label>Time Slot:</label>
                                <select class="form-control" name="selecttimeslotEdit">
                                    @if ($admin_request->timeSlot === "8.30-10.30")
                                        <option value="8.30-10.30" selected="selected">8.30 - 10.30</option>
                                        <option value="10.30-12.30">10.30 - 12.30</option>
                                        <option value="12.30-1.30">12.30 - 1.30</option>
                                        <option value="1.30-3.30">1.30 - 3.30</option>
                                        <option value="3.30-5.30">3.30 - 5.30</option>
                                    @elseif ($admin_request->timeSlot === "10.30-12.30")
                                        <option value="8.30-10.30">8.30 - 10.30</option>
                                        <option value="10.30-12.30" selected="selected">10.30 - 12.30</option>
                                        <option value="12.30-1.30">12.30 - 1.30</option>
                                        <option value="1.30-3.30">1.30 - 3.30</option>
                                        <option value="3.30-5.30">3.30 - 5.30</option>
                                    @elseif ($admin_request->timeSlot === "12.30-1.30")
                                        <option value="8.30-10.30">8.30 - 10.30</option>
                                        <option value="10.30-12.30">10.30 - 12.30</option>
                                        <option value="12.30-1.30" selected="selected">12.30 - 1.30</option>
                                        <option value="1.30-3.30">1.30 - 3.30</option>
                                        <option value="3.30-5.30">3.30 - 5.30</option>
                                    @elseif ($admin_request->timeSlot === "1.30-3.30")
                                        <option value="8.30-10.30">8.30 - 10.30</option>
                                        <option value="10.30-12.30">10.30 - 12.30</option>
                                        <option value="12.30-1.30">12.30 - 1.30</option>
                                        <option value="1.30-3.30" selected="selected">1.30 - 3.30</option>
                                        <option value="3.30-5.30">3.30 - 5.30</option>
                                    @elseif ($admin_request->timeSlot === "3.30-5.30")
                                        <option value="8.30-10.30">8.30 - 10.30</option>
                                        <option value="10.30-12.30">10.30 - 12.30</option>
                                        <option value="12.30-1.30">12.30 - 1.30</option>
                                        <option value="1.30-3.30">1.30 - 3.30</option>
                                        <option value="3.30-5.30" selected="selected">3.30 - 5.30</option>
                                    @endif

                                </select>
                            </div>


                            <div class="form-group">
                                <label>Staff Member</label>
                                <select class="form-control" name="selectstaffEdit">

                                    @foreach($users as $user)
                                        @if($admin_request->lecturerID === $user->staff_id)
                                            <option value="{{$user->staff_id}}" selected="selected">{{$user->name}}</option>
                                        @else
                                            <option value="{{$user->staff_id}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- select Year  -->
                            <div class="form-group">
                                <label>Year</label>
                                <select class="form-control" name="selectyearEdit">
                                    @if ($admin_request->year === "Y1")
                                        <option value="Y1" selected="selected"> 1</option>
                                        <option value="Y2"> 2</option>
                                        <option value="Y3"> 3</option>
                                        <option value="Y4"> 4</option>
                                    @elseif ($admin_request->year === "Y2")
                                        <option value="Y2" selected="selected"> 2</option>
                                        <option value="Y1" > 1</option>
                                        <option value="Y3"> 3</option>
                                        <option value="Y4"> 4</option>
                                    @elseif ($admin_request->year === "Y3")
                                        <option value="Y3" selected="selected"> 3</option>
                                        <option value="Y1" > 1</option>
                                        <option value="Y2"> 2</option>
                                        <option value="Y4"> 4</option>
                                    @elseif ($admin_request->year === "Y4")
                                        <option value="Y4" selected="selected"> 4</option>
                                        <option value="Y1" > 1</option>
                                        <option value="Y2"> 2</option>
                                        <option value="Y3"> 3</option>
                                    @endif

                                </select>
                            </div>

                            <!-- select Batch -->
                            <div class="form-group">
                                <label>Batch</label>
                                <select class="form-control" name="selectbatchEdit">
                                    @foreach($batches as $batch)
                                        @if($admin_request->batchNo === $batch->id)
                                            <option value="{{$batch->ide}}" selected="selected"> {{$batch->batchNo}}</option>
                                        @else
                                            <option value="{{$batch->id}}"> {{$batch->batchNo}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>

                            <!-- select Subject -->
                            <div class="form-group">
                                <label>Subject</label>
                                <select class="form-control" name="selectsubEdit">

                                    @foreach($subjects as $subject)
                                        @if($admin_request->subjectCode === $subject->id)
                                            <option value="{{$subject->id}}" selected="selected"> {{$subject->subName}}</option>
                                        @else
                                            <option value="{{$subject->id}}"> {{$subject->subName}}</option>
                                            @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- select Hall -->
                            <div class="form-group">
                                <label>Lecture Hall/Lab</label>
                                <select class="form-control" name="selectresEdit">

                                    @foreach($resources as $resource)
                                        @if($admin_request->resourceID === $resource->hallNo)
                                            <option value="{{$resource->hallNo}}" selected="selected"> {{$resource->hallNo}}</option>
                                        @else
                                            <option value="{{$resource->hallNo}}"> {{$resource->hallNo}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="selectStatusEdit">
                                    @if ($admin_request->status === "Approved")
                                        <option value="Approved" selected="selected">Approved</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancelled">Cancelled</option>
                                    @elseif ($admin_request->status === "Pending")
                                        <option value="Pending" selected="selected">Pending</option>
                                        <option value="Approved" >Approved</option>
                                        <option value="Cancelled">Cancelled</option>
                                    @elseif ($admin_request->status === "Cancelled")
                                        <option value="Cancelled" selected="selected">Cancelled</option>
                                        <option value="Approved" >Approved</option>
                                        <option value="Pending">Pending</option>
                                    @endif
                                </select>
                            </div>



                            <button type="submit " class="btn btn-primary pull-right">Update</button>
                            <a href="/adminRequest" class="btn btn-primary">Cancel</a>
                        </form>
                    </div>
                    <!-- /.box-body -->


                </div>
            </div>
        </div>
    </div>
@endsection
