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
      <div class="col col-sm-4">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Resource</h3>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
<!--      Form  -->
             <form role="form" method="post" action="/resource/UpdateResource/{{$resource->id}}">
                 {{method_field('PATCH')}}
                 
                <!-- Hall Number input -->
                <div class="form-group" >
                  <label>Hall Number</label>
                  <input type="text" name="hallNoEdit" class="form-control" placeholder="Enter Hall Number ..." value="{{$resource->hallNo}}">
                </div>

                  
                  <!--Capacity input-->
                <div class="form-group">
                  <label>Capacity</label>
                  <input type="text" name="capacityEdit" class="form-control" placeholder="Enter Capacity ..." value="{{$resource->capacity}}">
                </div>

                   <!--type input-->
                   <div class="form-group">
                  <label>Type</label>
                    <select class="form-control" name="selectTypeEdit">
                     @if ($resource->type === "Lecture Hall")
                        <option value="Lecture Hall" selected="selected"> Lecture Hall</option>
                     @elseif ($resource->type === "Lab")
                        <option value="Lab"> Lab</option>
                     @endif
                        <option value="Lecture Hall"> Lecture Hall</option>
                        <option value="Lab"> Lab</option>
                    </select>
                </div>

                 <button type="submit " class="btn btn-primary pull-right">Edit</button>
                 
                   {!! csrf_field() !!}
              </form> <!-- /.form-->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</div>
@endsection
