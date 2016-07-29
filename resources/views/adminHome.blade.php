@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Home</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">

            <!-- Request Management -->
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Requests</h3>

                        <p>View Requests</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-calendar-outline"></i>
                    </div>
                    <a href="/adminRequest" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- User Management -->
            <div class="col-md-4">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 style="font-size: 30px;">User Management</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/UserManagement" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Resource Management -->
            <div class="col-md-4">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Resource Management</h3>

                        <p>Resource Management</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/resource/show" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- row 2 -->
        <div class="row">

            <!-- Subject Management -->
            <div class="col-md-3">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Subject <br> Management</h3>

                        <p>Add or remove Subjects</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-book-outline"></i>
                    </div>
                    <a href="/subject" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Batch Management -->
            <div class="col-md-3">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Batch <br> Management</h3>

                        <p>Add or remove Batches</p>
                    </div>
                    <div class="icon">
                        <i class="ion-android-folder-open"></i>
                    </div>
                    <a href="/batch" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Timetable Management -->
            <div class="col-md-3">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Timetable <br> Management</h3>

                        <p>Add or remove Timetables</p>
                    </div>
                    <div class="icon">
                        <i class="ion-clock"></i>
                    </div>
                    <a href="/timetable" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    </div>
@endsection