@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Time Table Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Timetable</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Users <small> *Users who are allowed to register</small></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="POST" action="/timetable/batchTimetableForm/batch_Timetable" name="batchTimetableForm" id="batchTimetableForm">
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
                                $.get("{{ url('/timetable/batchTimetableForm/loadBatches')}}", {option: $('#selectyear').val()},

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

                                    $.get("{{ url('/timetable/batchTimetableForm/loadBatches')}}", {option: $(this).val()},

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

                        <div class="form-group">
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">View Timetable</button>
                            </div>
                        </div>


                        {!! csrf_field() !!}
                    </form>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div> <!-- ./row -->
@endsection