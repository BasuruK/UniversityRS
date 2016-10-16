@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>
            Batch Timetable
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
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Batch {{$batch}}</h3>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-gear"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" id="exportXLS" onclick="exportXLS()">Export excel</a></li>
                            <li><a href="#" id="exportPDF" onclick="exportPDF()">Export PDF</a></li>
                        </ul>
                    </div>

                </div>
    <div id="batchTable" class="box-body">
        <table id="batchTimeTable" class="table table-bordered">
            <tbody>
            <tr>
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>

        @foreach($fullTimeTable as $timeTable)

            <!-- Time -->
                <tr>
                    <td>{{ $timeTable->time }}</td>
                    <!-- Monday -->
                    <td id="{{ $timeTable->time24Format }}-monday"> </td>
                    <!-- Tuesday -->
                    <td id="{{ $timeTable->time24Format }}-tuesday"> </td>
                    <!-- Wednesday -->
                    <td id="{{ $timeTable->time24Format }}-wednesday"> </td>
                    <!-- Thursday -->
                    <td id="{{ $timeTable->time24Format }}-thursday"> </td>
                    <!-- Friday -->
                    <td id="{{ $timeTable->time24Format }}-friday"> </td>
                    <!-- Saturday -->
                    <td id="{{ $timeTable->time24Format }}-saturday"> </td>
                    <!-- Sunday -->
                    <td id="{{ $timeTable->time24Format }}-sunday"> </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <script>
                var batchTimetableDetails = 0;
                batchTimetableDetails = <?php echo json_encode($BatchTimeDetails) ?>;

                try {
                    for (var i = 0; i < batchTimetableDetails.length; i++) {

                        timeSlotDB = batchTimetableDetails[i].timeSlot;
                        startFrom         = timeSlotDB.split(" ")[0];
                        endTime           = timeSlotDB.split(" ")[2];
                        totalNoOfHours       = endTime - startFrom;

                        for (var j = 0; j < totalNoOfHours; j++) {
                            hourlyTimePeriod = parseFloat(startFrom) + 1;
                            timeFromStartToEnd = startFrom + " " + "-" + " " + hourlyTimePeriod + "0";

                            document.getElementById(timeFromStartToEnd + "-" + batchTimetableDetails[i].day).innerHTML = batchTimetableDetails[i].subjectCode + " <br><div>Hall: " + batchTimetableDetails[i].resourceName + "</div><div> Lecturer: " + batchTimetableDetails[i].lecturerName + "</div>";

                            // Css styling
                            // document.getElementById(timeFromStartToEnd + "-" + batchTimetableDetails[i].day).style["border-width"]= "2px";

                            // if(totalHoursNeed >= 1) {
                            //document.getElementById(timeFromStartToEnd + "-" + batchTimetableDetails[i].day).style["border-bottom-color"] = "transparent";
                            document.getElementById(timeFromStartToEnd + "-" + batchTimetableDetails[i].day).style["background-color"] = "lightgray";
                            startFrom = parseFloat(startFrom) + 1 + ("0");
                        }
                    }


                }
                catch (exception)
                {

                }
            </script>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </div>

@endsection