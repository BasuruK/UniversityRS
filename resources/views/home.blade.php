@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>
       Welcome
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Home</li>
    </ol>
</section>
@endsection

@section('content')
<div class="container-fluid">
        <div class="row">

            <div class="col-md-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Requests</h3>

                        <p>Place Requests</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-aperture"></i>
                    </div>
                    <a href="/userRequest/requestForm" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 style="font-size: 30px;">My Requests</h3>

                        <p>View Requests</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-map"></i>
                    </div>
                    <a href="/userRequest/Show" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 style="font-size: 30px;">My Timetable<sup style="font-size: 20px"></sup></h3>

                        <p>View Timetable</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-calendar-outline"></i>
                    </div>
                    <a href="/myTables" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Timetable Management -->
            <div class="col-md-3">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Timetable <br> Management</h3>

                        <p>View Timetables</p>
                    </div>
                    <div class="icon">
                        <i class="ion-clock"></i>
                    </div>
                    <a href="/timetable" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        @if($SemesterRegForm == 1)
            <!-- Semester Request -->
                <div class="col-md-3">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3 style="font-size: 30px;">Semester <br>Requests<sup style="font-size: 20px"></sup></h3>

                            <p>View Timetable</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-list-outline"></i>
                        </div>
                        <a href="/userRequest/requestFormSemester/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
        @endif
    </div>
</div>
@endsection
