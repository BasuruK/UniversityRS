@extends('layouts.Main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col-sm-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Request</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" method="POST" action="/adminRequest/add" >

                        {!! csrf_field() !!}

                        <!--Date-->
                           <div class="form-group">
                                <label>Date:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="selectdate">
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

                            <!-- select time slot -->
                            <div class="form-group">
                                <label>Time Slot:</label>
                                <select class="form-control" name="selecttimeslot">
                                    <option value="8.30-10.30">8.30 - 10.30</option>
                                    <option value="10.30-12.30">10.30-12.30</option>
                                    <option value="12.30-1.30">12.30-1.30</option>
                                    <option value="1.30-3.30">1.30-3.30</option>
                                    <option value="3.30-5.30">3.30-5.30</option>
                                </select>
                            </div>

                            <!-- select staff member -->
                            <div class="form-group">
                                <label>Staff Member</label>
                                <select class="form-control" name="selectstaff">
                                    @foreach($users as $user)
                                        <option value="{{$user->staff_id}}"> {{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- select Year  -->
                            <div class="form-group">
                                <label>Year</label>
                                <select class="form-control" name="selectyear">
                                    <option value="Y1"> 1</option>
                                    <option value="Y2"> 2</option>
                                    <option value="Y3"> 3</option>
                                    <option value="Y4"> 4</option>
                                </select>
                            </div>

                            <!-- select Batch -->
                            <div class="form-group">
                                <label>Batch</label>
                                <select class="form-control" name="selectbatch">
                                    @foreach($batches as $batch)
                                        <option value="{{$batch->id}}"> {{$batch->batchNo}}</option>
                                    @endforeach
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
                                <select class="form-control" name="selectres">

                                    @foreach($resources as $resource)
                                        <option value="{{$resource->hallNo}}">{{$resource->hallNo}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <!-- select status  -->
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="selectstatus">
                                    <option value="Approved">Approved</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>

                            <button type="submit " class="btn btn-primary pull-right">Submit</button>
                            <a href="/adminRequest" class="btn btn-primary">Cancel</a>
                        </form>
                    </div>
                    <!-- /.box-body -->


                </div>
            </div>
        </div>
    </div>
@endsection