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
                                                timePicker: true,
                                                timePickerIncrement: 30,
                                                locale: {
                                                    format: 'DD/MM/YYYY h:mm A'
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                            <!-- select staff member -->
                            <div class="form-group">
                                <label>Staff Member</label>
                                <select class="form-control" name="selectstaff">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}"> {{$user->name}}</option>
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
                                        <option value="{{$subject->subCode}}"> {{$subject->subName}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- select Hall -->
                            <div class="form-group">
                                <label>Lecture Hall/Lab</label>
                                <select class="form-control" name="selectres">

                                    @foreach($resources as $resource)
                                        <option value="{{$resource->id}}"> {{$resource->hallNo}}</option>
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