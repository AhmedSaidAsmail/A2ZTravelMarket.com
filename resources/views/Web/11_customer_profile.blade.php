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
                    <h1>Profile Details</h1>
                    <form method="post" action="">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{Auth::guard('customer')->user()->id}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{Auth::guard('customer')->user()->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{Auth::guard('customer')->user()->email}}">
                        </div>
                        <div class="form-group">
                            <label>Street / No</label>
                            <input type="text" class="form-control" name="address" value="{{Auth::guard('customer')->user()->address}}">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" value="{{Auth::guard('customer')->user()->city}}">
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" value="{{Auth::guard('customer')->user()->country}}">
                        </div>
                        <div class="form-group">
                            <label>Mobile Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{Auth::guard('customer')->user()->phone}}">
                        </div>
                        <button class="btn btn-info">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
