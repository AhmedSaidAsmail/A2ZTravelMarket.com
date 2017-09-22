@extends('Web.Layouts.master')
@section('meta_tags')
@if (Auth::guard('customer')->check())
<meta http-equiv="refresh" content="5; url={{route('home')}}">
@endif
<title>Join A2zTravelMarket.com</title>
@endsection
@section('content')
@if(session('sucess_reset'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h3>Your Password has benn reset</h3>
</div>
@endif
@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="register-contianer">
    <span class="fa-stack">
        <i class="fa fa-bookmark fa-stack-2x"></i>
        <i class="fa fa-star fa-stack-1x fa-inverse"></i>
    </span>
    <h1>Log in to A2ZTravel</h1>
    @if (Auth::guard('customer')->check())
    <h1>you are already logged in, you will redirect to home after 5 seconds</h1>
    @else
    <div class="row">
        <div class="col-md-8 col-md-push-2" >
            <div>
                <span>Log in to add things to your wishlist and access your bookings from any device.</span>
                <a class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i>Log in with Facebook</a>
                <a class="btn btn-block btn-social btn-default"><i class="fa fa-google"></i>Log in with Google</a>
                <span class="login-or">or</span>
                <form method="post" action="{{route('customer.login')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" value="" placeholder="Email address">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" value="" placeholder="Password">
                    </div>
                    <div class="row" >
                        <div class="col-md-6 text-left">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>

                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{route('customer.password.reset')}}" class="reset-password">Forgot your password?</a>
                        </div>
                    </div>
                    <button class="btn btn-info btn-block">Log in</button>
                </form>

                <div class="sign-up-section">
                    New here? <a href="{{route('customer.register')}}">Sign up here!</a> 
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection