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

        <form method="post" action="{{route('customer.password.reset.final')}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="email" value="{{$email}}">
            <input type="hidden" name="token" value="{{$token}}">
            <div class="form-group">
                <label>New password for {{$email}}</label>
                <input type="password" name="password" class="form-control" value="" required>
            </div>
            <div class="form-group">
                <label>Confirm the new password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>
            <button class="btn btn-info btn-block">Set New Password</button>            
        </form>

    </div>
</div>

@endsection