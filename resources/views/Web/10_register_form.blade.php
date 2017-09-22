@extends('Web.Layouts.master')
@section('meta_tags')
<title>Join A2zTravelMarket.com</title>
@endsection
@section('content')
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
    <h1>Start Enjoying the Rewards of Our Free Membership!</h1>
    <div class="row">
        <div class="col-md-8 col-md-push-2" >
            <div>

                <ul>
                    <li>Save up to 30% on selected activities</li>
                    <li>Sync your wishlist across all devices</li>
                    <li>Cancel easily online for many activities</li>
                </ul>
                <a class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i>Log in with Facebook</a>
                <a class="btn btn-block btn-social btn-default"><i class="fa fa-google"></i>Log in with Google</a>
                <span class="login-or">or</span>
                <form method="post" action="{{route('customer.register')}}" autocomplete="off" name="rigister-form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="" placeholder="Full Name" autocomplete="off">
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="email" class="form-control email-autocompelete-off" name="email" value="" placeholder="Email address" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">

                        <input type="password" class="form-control" name="password" value="" placeholder="Password">
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-left" style="padding-left: 0px;">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="newsletter" value="1">  Receive travel tips and promotions
                                </label>
                            </div>

                        </div>

                    </div>
                    <button class="btn btn-info btn-block btn-register">Create Acount</button>  
                </form>

                <div class="sign-up-section">
                    Already a member? <a href="#" id="login_now">Log in</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection