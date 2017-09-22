@extends('Web.Layouts.master')
@section('meta_tags')
<title>Reset Password</title>
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
<div class="row">
    <div class="col-md-8 sp-reset">
        @if(session('failure-email'))
        <div class="alert alert-warning">
            <strong>Warning!</strong> Email account does not exist.
        </div>
        @endif
        <h1>Reset Password</h1>
        <span>Enter the email address associated with your account  and we'll send you a link to reset your password.</span>
        <form method="post" action="{{route('customer.password.reset')}}">
            {{csrf_field()}}
            <div class="form-group">
                <input type="email" name="email" class="form-control" value="">
            </div>
            <button class="btn btn-info btn-block">Send Reset Link</button>            
        </form>

    </div>
</div>

@endsection