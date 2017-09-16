@extends('Web.Layouts.master')
@section('meta_tags')

@endsection
@section('header-nav')
<div class="row">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <img src="images/flash/flash1.jpg" alt="Pyramids">
            </div>
            <div class="item">
                <img src="images/flash/flash2.jpg" alt="Luxor">
            </div>
            <div class="item">
                <img src="images/flash/flash3.jpg" alt="Sphnix">
            </div>
            <div class="item">
                <img src="images/flash/flash4.jpg" alt="Luxor">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="background-image: none;" >
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next" style="background-image: none;">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
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
<div id="top_attraction">
    <h1>Top Attractions</h1>
    <div id="top_attraction_container">
        <!-- to append show more items -->
        @foreach($topAttractions->chunk(4) as $chunks)
        <div class="row row-img-holder">
            @foreach($chunks as $topAttraction)
            <div class="col-md-3 col-img-holder">
                <div class="col-md-3-img">
                    <a href="{{route('attraction.show',['id'=>$topAttraction->id])}}">
                        <img src="{{asset('images/attraction/thumb/'.$topAttraction->img)}}" class="img-abs-center" alt="">
                        <div class="tour-label">{{ucfirst($topAttraction->name)}}</div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    @if($moreAttraction)
    <div class="row text-center show-more">
        <button class="btn btn-info">Show more attractions</button>
    </div>
    @endif
</div>  
<div id="top_destetion">
    <h1>Top Destinations</h1>
    <div id="top_attraction_container">
        <!-- to append show more items -->
        @foreach($topCitis->chunk(4) as $chunks)
        <div class="row row-img-holder">
            @foreach($chunks as $topCity)
            <div class="col-md-3 col-img-holder">
                <div class="col-md-3-img">
                    <a href="">
                        <img src="{{asset('images/sorts/thumb/'.$topCity->img)}}" class="img-abs-center" alt="">
                        <div class="tour-label">{{$topCity->name}}</div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    @if($moreCity)
    <div class="row text-center show-more">
        <button class="btn btn-info">Show more destinations</button>
    </div>
    @endif
</div>  

@endsection