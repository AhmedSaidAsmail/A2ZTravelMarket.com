@extends('Web.Layouts.master')
@section('meta_tags')

@endsection
@section('header-nav')
<div class="row">
    <div class="img-top-title">
        <img src="{{asset('images/sorts/'.$city->img)}}" class="img-abs-center" alt="{{$city->name}}">
        <h1 class="top-title">{{ucfirst($city->name)}}</h1>
    </div>
</div>
<div class="row under-slides">
    <div class="container">
        <div class="row under-slides-container">
            <div class="col-md-3">
                <span class="under-slides-title">A2ZTravelMarket gives you</span>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-2">
                        <i class="fa fa-gift fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-10">
                        <span>The best selection</span>
                        More than 31,330 things to do
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-2">

                        <span class="fa-stack">
                            <i class="fa fa-certificate fa-stack-2x"></i> 
                            <i class="fa fa-usd fa-inverse fa-stack-1x"></i>
                        </span>
                    </div>
                    <div class="col-md-10">
                        <span>The lowest prices</span>
                        We guarantee it!
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-2">
                        <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-10">
                        <span>Fast & easy booking</span>
                        Book online to lock in your tickets
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('content')
<h2 class="city-main-header">Top Tours & Activities in {{$city->name}}</h2>
<div class="row item-addetional">

    @foreach($items as $itemRec)
    <a href="{{route('tour.show',['city'=>$itemRec->attraction->sort->name,'tour'=>$itemRec->name,'id'=>$itemRec->id])}}" class="item-tour-link">
        <div class="col-md-3">
            <div class="item-addetional-holder">
                <div class="item-addetional-price">
                    from
                    <span>
                        {!! \App\Http\Controllers\Web\ItemsController::getLowestPrice($itemRec->id)!!}
                    </span>
                </div>
                <div class="item-addetional-rate">
                    {{ App\Http\Controllers\ReviewController::getRateStar(App\Http\Controllers\ReviewsRateCalculate::calc($itemRec->id,'overall_rating')) }}
                    <span>{{count($itemRec->reviews()->where('confirm',1)->get())}} {{Vars::getVar('Reviews')}}</span>
                </div>
                <div class="item-addetional-img">
                    <img src="{{asset('images/items/thumb/'.$itemRec->img)}}" class="img-abs-center" alt="{{$itemRec->name}}">
                </div>
                <h2>{{$itemRec->name}}</h2>
                <span class="item-addetional-duration">
                    <i class="fa fa-clock-o"></i> 
                    <label>{{Vars::getVar('Duration')}}:</label> {{$itemRec->duration}} {{Vars::getVar('hours')}}
                </span>
            </div>
        </div>
    </a>
    @endforeach
</div>
<div class="row text-center city-see-all">
    <button class="btn btn-info">See all tours & things to do in Cairo Pyramids</button>
</div>
<h2 class="city-main-header">The {{count($attractions)}} best things to do in {{$city->name}}</h2>
<div class="row">
    <div class="col-md-8 city-text">
        {{$city->txt}}
    </div>
</div>

<?php $arrangment = 1; ?>
@foreach($attractions->slice(0,4)->chunk(2) as $chunk)
<div class="row city-attractions">
    @foreach($chunk as $attraction)
    <div class="col-md-6">
        <div class="city-img">
            <img src="{{asset('images/attraction/'.$attraction->img)}}" alt="{{$attraction->name}}" class="img-abs-center">
        </div>
        <h3 class="city-title-item"> {{$arrangment}}. {{$attraction->name}}</h3>
        <p class="city-text-insider">{!!$attraction->txt !!}</p>
    </div>
    <?php $arrangment++ ?>
    @endforeach
</div>
@endforeach
@foreach($attractions->slice(4)->chunk(4) as $chunk)
<div class="row city-attractions">
    @foreach($chunk as $attraction)
    <div class="col-md-3">
        <div class="city-img-2">
            <img src="{{asset('images/attraction/'.$attraction->img)}}" alt="{{$attraction->name}}" class="img-abs-center">
        </div>
        <h3 class="city-title-item"> {{$arrangment}}. {{$attraction->name}}</h3>
        <p class="city-text-insider">{!!$attraction->txt !!}</p>
    </div>   
    <?php $arrangment++ ?>
    @endforeach
</div>
@endforeach
<h1 class="country-info-header">Good to Know</h1>
<div class="row country-info">
    <div class="col-md-4">
        <i class="fa fa-info-circle"></i>
        language
        <span class="country-info-details">{{$country->language}}</span>
    </div>
    <div class="col-md-4">
        <span class="fa-stack">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dollar fa-inverse fa-stack-1x"></i>
        </span>
        Currency
        <span class="country-info-details">{{$country->currency}}</span>
    </div>
    <div class="col-md-4">
        <i class="fa fa-globe"></i>
        Time Zone
        <span class="country-info-details">{{$country->time}}</span>
    </div>
</div>
<div class="row country-info">
    <div class="col-md-4">
        <i class="fa fa-phone"></i>
        Country Code
        <span class="country-info-details">{{$country->code}}</span>
    </div>
    <div class="col-md-4">
        <i class="fa fa-calendar-o"></i>
        Best time to visit
        <span class="country-info-details">{{$country->best_time}}</span>
    </div>

</div>
@endsection