@extends('SupplierWeb.Layouts.master')
@section('container')
<div class="row supplier-body-holder">
    <div class="col-md-6 supplier-body-bg">
    </div>
    <div class="col-md-6">
        <span class="supplier-title-intro">
            <label>Online Booking Platform</label>
            for <label>Tours, Attractions,</label>
            and <label>Activities</label>
        </span>
        <span class="supplier-intro-help">
            A2ZTravelMarket markets your tours, attraction tickets, and travel experiences to millions of customers worldwide.
        </span>

        <a href="{{route('supplier.reigister')}}" class="btn btn-success btn-lg">Register for free</a>
        <span class="or">or</span>
        <a href="{{route('supplier.login')}}" class="supplier-intro-login">Login</a>
        <span class="take-less">it takes less than 5 minutes</span>

    </div>
</div>
<div class="row supplier-intro-body">
    <div class="row">
        <div class="col-md-6 supplier-body-title">
            <span>
                <i class="fa fa-users"></i>
                We increase your bookings
            </span>
            Sign up for free and reach new customers from around the world. We promote your products through our website and our distribution partners, bringing you more bookings
        </div>
        <div class="col-md-6 supplier-body-title">
            <span>
                <i class="fa fa-bullseye"></i>
                We connect you to the world of online travel
            </span>
            By partnering with GetYourGuide, your brand gets instant visibility on the web's leading travel websites and travel agencies, meaning increased revenue and worldwide exposure. 
        </div>
    </div> 
    <div class="row">
        <div class="col-md-6 supplier-body-title">
            <span>
                <i class="fa fa-upload"></i>
                We promote your brand
            </span>
            We display your company brand prominently on our website so customers know exactly what they are booking. Benefit from this free marketing for your brand.
        </div>
        <div class="col-md-6 supplier-body-title">
            <span>
                <i class="fa fa-hand-peace-o"></i>
                We make it easy
            </span>
            A personal account manager and help from our multilingual customer service team is just the beginning. You'll also get free product optimization and translation, powerful analytics tools, and easy payment services.
        </div>
    </div> 
</div>
@endsection