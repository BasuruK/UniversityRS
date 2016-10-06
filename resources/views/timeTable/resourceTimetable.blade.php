@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>User Timetables <small> Timetable assigned for Resource</small></h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Resource Timetable</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Timetable  *Timetable for resource {{$hallNo}}</h3>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-gear"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" id="exportXLS" onclick="exportXLS()">Export excel</a></li>
                            <li><a href="#" id="exportPDF" onclick="exportPDF()">Export PDF</a></li>
                        </ul>
                    </div>

                </div>
                <!-- /.box-header -->
                <div id="TableTable" class="box-body">
                    <table id="ResourceTimetable" class="table table-bordered" >
                        <tbody>
                        <tr>
                            <th>Time</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Sunday</th>
                        </tr>

                        @foreach($fullTimeTable as $timeTable)

                            <!-- Time for each day of the week -->
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
                        var resourceTimeData = 0;
                        resourceTimeData = <?php echo json_encode($ResourceTimeDetails) ?>;

                        try {
                            for (var i = 0; i < resourceTimeData.length; i++) {

                                timeSlot = resourceTimeData[i].timeSlot;
                                startTime         = timeSlot.split(" ")[0];
                                endTime           = timeSlot.split(" ")[2];
                                totalHours       = endTime - startTime;
                                endTimeOfPeriod      = parseFloat(startTime) + totalHours;

                                for (var k = 0; k < totalHours; k++) {


                                    timeCount           = parseFloat(startTime) + 1;
                                    timeOfBeginingAndEnd = startTime + " " + "-" + " " + timeCount + "0";

                                    document.getElementById(timeOfBeginingAndEnd + "-" + resourceTimeData[i].day).innerHTML = resourceTimeData[i].subjectCode + " <br>Lecturer: " + resourceTimeData[i].lecturerName + "</br>" + " Year: " + resourceTimeData[i].year + "<br> Batch: " + resourceTimeData[i].batchNo + "</br>";


                                    document.getElementById(timeOfBeginingAndEnd + "-" + resourceTimeData[i].day).style["background-color"] = "lightblue";

                                    startTime         = parseFloat(startTime) + 1 + ("0");

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