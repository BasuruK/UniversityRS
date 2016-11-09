@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>Resource Timetables <small> Timetable assigned for Resource</small></h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Resource Management</li>
            <li class="active">Resource Timetable</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Timetable for {{$hallNo}} {{$hallType}}</h3>
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

                        if(resourceTimeData==0)
                        {
                            document.getElementById('TableTable').innerHTML="This resource has not been assigned to any academic activities yet";
                        }
                        else
                        {
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
                        }

                        /**
                         * Exports the timetable in excel format
                         */
                        function exportXLS() {

                            var table_content = '<html xmlns:o="urn:schemas-microsoft-com:office:spreadsheet" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">';
                            table_content = table_content + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"/>';
                            table_content = table_content + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
                            table_content = table_content +  '<x:Name>Resource Timetable</x:Name>';
                            table_content = table_content +  '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
                            table_content = table_content +  '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
                            table_content = table_content +  '<h2 style="text-align: center;">SLIIT Resource Timetable for {{$hallNo}} {{$hallType}}</h2>';
                            table_content = table_content +  '<h3 style="text-align: right;">2016</h3>';
                            table_content = table_content +  "<table border='2px'";
                            table_content = table_content +  $('#ResourceTimetable').html();
                            table_content = table_content +  '</table></body></html>';

                            var data_type = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

                            $('#exportXLS').attr('href',data_type + ', ' + encodeURIComponent(table_content));
                            $('#exportXLS').attr('download','Resource Timetable.xls');
                        }


                        /**
                         * Exports the table as a pdf file
                         */
                        function exportPDF() {

                            var pdf = new jsPDF('l', 'mm', [550, 400]);
                            pdf.text("Resource Timetable for {{$hallNo}} {{$hallType}} ",400,20);

                            source = $('#TableTable')[0];

                            specialElementHandlers = {
                                '#bypassme': function (element, renderer) {
                                    return true
                                }
                            };
                            pdf.setFont("times");
                            margins = {
                                top: 20,
                                //bottom: 20,
                                left: 50,
                                //width: 522
                            };

                            pdf.fromHTML(
                                    source, margins.left, margins.top, {
                                        'width': margins.width, // max width of content on PDF
                                        'elementHandlers': specialElementHandlers
                                    },
                                    function (dispose) {
                                        pdf.save('Resource Timetable.pdf');
                                    }
                                    , margins);
                        }

                    </script>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection