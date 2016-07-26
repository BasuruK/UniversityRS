@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>User Timetables <small> Timetable assigned to user</small></h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">My Timetable</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Timetable <small> *Timetable for year 2016</small></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
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

                        var LecturerTimeData = 0;
                        LecturerTimeData = <?php echo json_encode($LecturesTimeDetails) ?>;
                        //console.log(LecturerTimeData);

                        try {
                            for (var i = 0; i < 9; i++) {

                                timeSlotFromDatabase = LecturerTimeData[i].timeSlot;
                                durationFrom = timeSlotFromDatabase.split(" ")[0];
                                durationTo = timeSlotFromDatabase.split(" ")[2];
                                //console.log(durationFrom + " - " + durationTo);
                                totalHoursNeed = durationTo - durationFrom;

                                //console.log("start Time : " + durationFrom);
                                //console.log("duration  : " + totalHoursNeed);

                                endTimeOfPeriod = parseFloat(durationFrom) + totalHoursNeed;

                                //

                                /**
                                 * 1. make start time end time pairs as hourly.
                                 * 2. assign it to the id of the field.
                                 * 3.  assign days array values to get the day.
                                 *
                                 */

                                for (var k = 0; k < totalHoursNeed; k++) {

                                    hourlyTime = parseFloat(durationFrom) + 1;
                                    timeOfBeginingAndEnd = durationFrom + " " + "-" + " " + hourlyTime + "0";
                                    //console.log("Final Output : " + timeOfBeginingAndEnd);
                                    durationFrom = parseFloat(durationFrom) + 1 + ("0");

                                    document.getElementById(timeOfBeginingAndEnd + "-" + LecturerTimeData[i].day).innerHTML = LecturerTimeData[i].subjectCode + " | " + LecturerTimeData[i].resourceName + "<br>Year : " + LecturerTimeData[i].year + "  " + "Batch : " + LecturerTimeData[i].batchNo;
                                }

                            }
                        }
                        catch (exception)
                        {
                            //ignore the errors
                        }
                    </script>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection