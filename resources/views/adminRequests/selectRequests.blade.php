@extends('layouts.Main')

@section('section-header')
    <section class="content-header">
        <h1>Requests Selection <small>Select Request Type</small></h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Request Selection</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <a href="/adminRequest">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="ion ion-ios-list-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Formal Requests</span>
                            <span class="info-box-number">View Formal Requests</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-md-4">
                <a href="/adminRequest/specialRequest">
                    <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="ion ion-ios-list-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Special Requests</span>
                            <span class="info-box-number">View Special Requests</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-md-4">
                <a href="/adminRequest/semesterRequest">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="ion ion-ios-list-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Semester Requests</span>
                            <span class="info-box-number">View Semester Requests</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection


