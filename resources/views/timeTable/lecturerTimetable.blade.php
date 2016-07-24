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
                            <td>{{ $timeTable->monday }}</td>
                            <!-- Tuesday -->
                            <td>{{ $timeTable->tuesday }}</td>
                            <!-- Wednesday -->
                            <td>{{ $timeTable->wednesday }}</td>
                            <!-- Thursday -->
                            <td>{{ $timeTable->thursday }}</td>
                            <!-- Friday -->
                            <td>{{ $timeTable->friday }}</td>
                            <!-- Saturday -->
                            <td>{{ $timeTable->saturday }}</td>
                            <!-- Sunday -->
                            <td>{{ $timeTable->sunday }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection