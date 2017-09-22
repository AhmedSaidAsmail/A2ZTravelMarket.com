@extends('Web.Layouts.master')
@section('meta_tags')
<title>Join A2zTravelMarket.com</title>
@endsection
@section('header-nav')
<div class="row insider-holder">
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

@include('Web.Layouts.setting_nav')
    <div class="row customer-setting">
        <div class="container">
            <div class="row">
                <div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
                    @include('Web.Layouts.profile_panel')

                </div>
                <div class="col-md-10 sp-profile">
                    <h1>Change password</h1>
                    <form method="post" action="{{route('customer.password')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{Auth::guard('customer')->user()->id}}">
                        <div class="form-group">
                            <label>New Password (6 to 32 characters long)</label>
                            <input type="password" class="form-control" name="password" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <button class="btn btn-info">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
