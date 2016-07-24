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
                        <h3>Requests<sup style="font-size: 20px"></sup></h3>

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
                        <h3>User Management</h3>

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
                    <h3>Resource Management</h3>

                    <p>Resource Management</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/resource/show" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


    </div>
@endsection