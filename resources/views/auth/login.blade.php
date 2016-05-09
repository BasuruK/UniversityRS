@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
          
         <a style="text-decoration:none" href={{ url('/') }}><h2 class="text-center" style="color:white"><b>University</b>RS</h2></a>
       
            <div class="panel panel-default" style="border-radius: none;">
                <div class="panel-heading text-center" style="background-color: #B6B6B6;">
                  <i class="fa fa-pied-piper fa-4x" aria-hidden="true"></i>
                  <h3>Sign in</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                      
                      <div class="col-md-12 text-center">
                        
                        <a href="{{ url('/register') }}" class="btn btn-default ">Sign Up</a>
                        <br><br>
                      </div>
                      
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                              <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                              </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                               <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-lock" aria-hidden="true"> </i></span>
                                <input type="password" class="form-control" name="password">
                               </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                              
                              <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Sign in
                                </button>

                                
                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
