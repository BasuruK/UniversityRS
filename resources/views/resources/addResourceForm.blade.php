@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>
       Add Resources
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Resource Management</li>
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
             <form role="form" method="post" action="/resource/Add">
                 
                <!-- Hall Number input -->
                <div class="form-group" >
                  <label>Hall Number</label>
                  <input type="text" name="hallNo" class="form-control" placeholder="Enter Hall Number ...">
                </div>

                  
                  <!-- Capacity input -->
                <div class="form-group">
                  <label>Capacity</label>
                  <input type="text" name="capacity" class="form-control" placeholder="Enter Capacity ...">
                </div>


                 <!--Type Input-->
                   <div class="form-group">
                  <label>Type</label>
                  <select class="form-control" name="selectType">
                    <option value="Lecture Hall"> Lecture Hall</option>
                    <option value="Lab"> Lab</option>
                  </select>
                </div>

                 @if (count($errors) > 0)
                     <div class="alert alert-danger">
                         <ul>
                             @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                             @endforeach
                         </ul>
                     </div>
                 @endif

                 <button type="submit " class="btn btn-primary pull-right">Submit</button>
                 
                   {!! csrf_field() !!}
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        
        <div class="col col-sm-8">
            <script>
/**
* Initialise DataTable for Resources
*/
$(document).ready(function() {
    $('#dataTableRegUsers').DataTable();
} );
                
function isDelete(id)
{
    var ID =id;
    $.confirm({
        theme: 'black',
        title: 'Confirm Deletion',
        icon: 'fa fa-warning',
        content: 'Are you sure want to remove this resource?',
        confirmButton: 'Yes',
        confirmButtonClass: 'btn-danger',
        confirm: function(){
            location.href="/resource/DeleteResource/"+ID;
        }
        
    });
    return false;
}
function isEdit(id) {
    var ID = id;
    $.confirm({
        theme: 'black',
        title: 'Confirm Deletion',
        icon: 'fa fa-warning',
        content: 'Are you sure want to Edit this resource?',
        confirmButton: 'Yes',
        confirmButtonClass: 'btn-danger',
        confirm: function () {
            location.href = "/resource/Edit/" + ID;
        }

    });
    return false;
}
</script>
             <div class="box">
        <div class="box-header">
          <h3 class="box-title">Resources</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="dataTableRegUsers_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                  <div class="col-sm-6"></div>
                  <div class="col-sm-6"></div>
              </div>
              <div class="row">
                  <div class="col-sm-12">
                      <table id="dataTableRegUsers" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="dataTableRegUsers_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Hall ID</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column descending" style="width: 55px;" aria-sort="ascending">Hall Number</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Prefix: activate to sort column ascending" style="width: 45px;">Capacity</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTableRegUsers" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 110px;">Type</th>
                                <th tabindex="0"  rowspan="1" colspan="1" aria-label="Edit/ Delete" style="width: 60px;">Edit/ Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resources as $resource1)
                            <tr role="row" class="odd">
                              <td class="sorting_1">{{ $resource1->id }}</td>
                              <td>{{ $resource1->hallNo}}</td>
                              <td>{{ $resource1->capacity }}</td>
                              <td>{{ $resource1->type }}</td>
                              <td>
                                  <a  onclick="return isEdit({{$resource1->id}})" class="btn btn-info">Edit</a>
                                  <a class="btn btn-danger pull-right" onclick="return isDelete({{$resource1->id}})">Delete</a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5">
                      <div class="dataTables_info" id="dataTableRegUsers_info" role="status" aria-live="polite"></div>
                  </div>
                  <div class="col-sm-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="dataTableRegUsers_paginate"></div>
                  </div>
              </div>
            </div>
        </div>
            <!-- /.box-body -->     
    </div> <!--/.box-->
 
        </div>
    </div>
</div>
@endsection
