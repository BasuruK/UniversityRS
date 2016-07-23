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
                        <h3>Requests</h3>

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
                        <h3>My Requests</h3>

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
                        <h3>My Timetable<sup style="font-size: 20px"></sup></h3>

                        <p>View Timetable</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-calendar-outline"></i>
                    </div>
                    <a href="/myTables" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
    </div>
</div>
@endsection
