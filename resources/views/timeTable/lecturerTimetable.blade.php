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
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-gear"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" id="test" onclick="exportXLS()">Export excel</a></li>
                            <li><a href="#">Export PDF</a></li>
                        </ul>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="LecturerTimetable" class="table table-bordered">
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

                        //Generate the timetable
                        var LecturerTimeData = 0;
                        LecturerTimeData = <?php echo json_encode($LecturesTimeDetails) ?>;

                        try {
                            for (var i = 0; i < 9; i++) {

                                timeSlotFromDatabase = LecturerTimeData[i].timeSlot;
                                durationFrom         = timeSlotFromDatabase.split(" ")[0];
                                durationTo           = timeSlotFromDatabase.split(" ")[2];
                                totalHoursNeed       = durationTo - durationFrom;
                                endTimeOfPeriod      = parseFloat(durationFrom) + totalHoursNeed;

                                for (var k = 0; k < totalHoursNeed; k++) {

                                    hourlyTime           = parseFloat(durationFrom) + 1;
                                    timeOfBeginingAndEnd = durationFrom + " " + "-" + " " + hourlyTime + "0";
                                    durationFrom         = parseFloat(durationFrom) + 1 + ("0");
                                    document.getElementById(timeOfBeginingAndEnd + "-" + LecturerTimeData[i].day).innerHTML = LecturerTimeData[i].subjectCode + " | " + LecturerTimeData[i].resourceName + "<br>Year : " + LecturerTimeData[i].year + "  " + "Batch : " + LecturerTimeData[i].batchNo;
                                }
                            }
                        }
                        catch (exception)
                        {
                            //ignore the errors
                        }


                        /**
                         * Exports the timetable in excel format
                         */
                        function exportXLS() {

                            var table_content = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
                            table_content = table_content + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
                            table_content = table_content +  '<x:Name>Semester Timetable</x:Name>';
                            table_content = table_content +  '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
                            table_content = table_content +  '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
                            table_content = table_content +  "<table border='2px'";
                            table_content = table_content +  $('#LecturerTimetable').html();
                            table_content = table_content +  '</table></body></html>';

                            var data_type = 'data:application/vnd.ms-excel';

                            $('#test').attr('href',data_type + ', ' + encodeURIComponent(table_content));
                            $('#test').attr('download','Semester Timetable.xls');
                        }

                    </script>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection