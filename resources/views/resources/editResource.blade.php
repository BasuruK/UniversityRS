@extends('layouts.Main')

@section('section-header')
<section class="content-header">
    <h1>
       Welcome
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="">Resource Management</li>
        <li class="active">Edit Resource</li>
    </ol>
</section>
@endsection

@section('content')
    <div class="row">
        <div class="col col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Resource</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!--      Form  -->
                    <form role="form" method="post" action="/resource/UpdateResource/{{$resource->id}}" name="resourceEdit">
                    {{method_field('PATCH')}}
                    {!! csrf_field() !!}

                    <!-- Hall Number input -->
                        <div class="form-group" >
                            <label>Hall Number</label>
                            <input type="text" name="hallNoEdit" id="hallNoEdit" class="form-control"  value="{{$resource->hallNo}}">
                        </div>


                        <!--Capacity input-->
                        <div class="form-group">
                            <label>Capacity</label>
                            <input type="text" name="capacityEdit" id="capacityEdit" class="form-control"  value="{{$resource->capacity}}">
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

                        <button type="submit " onclick="return ValidateForm() " class="btn btn-primary pull-right">Edit</button>
                        <a href="/resource/show" class="btn btn-primary">Cancel</a>
                            <div class="alert alert-danger" id="errordisplay" style="display:none">
                                @if (count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>


                        <script>
                            function Success()
                            {
                                $.notify("Your Resource has been successfully Edited", "success",
                                        {position:"center"}
                                );
                            }
                            function ValidateForm()
                            {

                                var hallnumber=$('#hallNoEdit').val();
                                var capacity=$('#capacityEdit').val();



                                if(hallnumber == "")
                                {
                                    //set the display value to empty on the style so that the div will be displayed
                                    $("#errordisplay").css('display','');
                                    $('#errordisplay').text("Hall Number cannot be empty");
                                    return false;
                                }


                                if(capacity == "")
                                {
                                    //set the display value to empty on the style so that the div will be displayed
                                    $("#errordisplay").css('display','');
                                    $('#errordisplay').text("Capacity cannot be empty");
                                    return false;
                                }
                                if($.isNumeric(capacity)==false)
                                {
                                    //set the display value to empty on the style so that the div will be displayed
                                    $("#errordisplay").css('display','');
                                    $('#errordisplay').text("Capacity Should be a number");
                                    return false;
                                }


                                //submit the form is there are no errors
                                $('#resourceEdit').submit();
                                Success();
                            }
                        </script>

>>>>>>> origin/Sandamini
                    </form> <!-- /.form-->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
