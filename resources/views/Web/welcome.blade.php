@extends('Web.Layouts.master')
@section('meta_tags')

@endsection
@section('header-nav')

@include('Web.Layouts.MainMenu')
<div class="row" style="position: relative;">
    <div class="search-top-sliders row">
        <div class="row">
            <div class="col-md-12 search-top-insider">
                <div class="row search-top-header" style="position: relative;">
                    <img src="images/lets-go.png" alt="let's go Hurghada Wonders" class="search-logo">
                    <span class="search-slogan">{{Vars::getVar('the_activities_begin')}} <i class="fa fa-heart-o" aria-hidden="true"></i></span>
                </div>
                <form action="{{route('Web.searchItems')}}" method="get" id="serach-items-result">
                    <div class="row search-form">
                        <div class="col-md-10 col-sm-10 col-xs-9">
                            <div class="form-group" style="position: relative;">
                                <input type="text" value="" class="form-control" id="welcome-search" placeholder="Search for destentions, attractions and tours">
                                <div class="welcome-search-result" id="search-result">
                                    <!-- search Result -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-3">
                            <button type="submit" class="btn btn-info btn-block">{{Vars::getVar('LETS_GO')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <img src="{{asset('images/flash/flash1.jpg')}}" alt="Pyramids">
            </div>
            <div class="item">
                <img src="{{asset('images/flash/flash2.jpg')}}" alt="Luxor">
            </div>
            <div class="item">
                <img src="{{asset('images/flash/flash3.jpg')}}" alt="Sphnix">
            </div>
            <div class="item">
                <img src="{{asset('images/flash/flash4.jpg')}}" alt="Luxor">
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
@endsection
@section('content')
<!-- real insider -->
<div class="row welcome-conatiner">
    <div class="container">
        <div class="home-title">
            <div class="row-title">{{Vars::getVar('TOP_EXCURSIONS_IN')}} <span>{{Vars::getVar('HURGHADA')}}</span>
            </div>
            <div class="row-line"></div>

        </div>
        <div class="row">
            @foreach($items->slice(0,4) as $topItems)
            <a href="{{route('tour.show',['city'=>urlencode($topItems->sort->name),'tour'=>urlencode($topItems->name),'id'=>$topItems->id])}}">
                <div class="col-md-3">
                    <div class="welcome-exc-item">
                        <div class="welcome-exc-img">
                            <img src="{{asset('images/items/thumb/'.$topItems->img)}}" alt="{{$topItems->title}}">
                            <div class="welcome-rating">
                                <span>5</span>
                                <i class="fa fa-star st-star"></i>
                                <i class="fa fa-star sec-star"></i>
                            </div>
                            <div class="welcome-price">{{Vars::getVar('£')}}
                                @if(isset($topItems->price))
                                {{sprintf('%.2f',$topItems->price->st_price)}}
                                @endif
                            </div>
                        </div>
                        <div class="welcome-exc-info">
                            <h1>{{$topItems->name}} </h1>
                            <p>
                                {{str_limit($topItems->intro, $limit = 100, $end = '...')}}
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </p>
                        </div>

                    </div>
                </div>
            </a>
            @endforeach

        </div>
        <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
            <div class="col-md-8" style="padding-right: 0px;">
                <div class="home-title">
                    <div class="row-title">{{Vars::getVar('FIND_MORE')}}  <span>{{Vars::getVar('EXCURSIONS')}}</span>
                    </div>
                    <div class="row-line"></div>
                </div>
                <!-- exc Items Sector -->
                @foreach($items->slice(4,7) as $item)
                <div class="row exc-items">
                    <div class="col-md-4">
                        <div class="exc-item-img">
                            <div class="exc-item-img-container">
                                <img src="{{asset('images/items/thumb/'.$item->img)}}" alt="{{$item->title}}" class="img-abs-center">
                            </div>
                            <span class="fa fa-caret-left fa-4x"></span>
                            <div class="exc-img-shadow"></div>
                        </div>
                    </div>
                    <div class="col-md-8 exc-item-info">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>{{$item->name}}</h2>
                                <span class="exc-item-duration"><i class="fa fa-clock-o fa-lg" aria-hidden="true"></i>
                                    <label>{{Vars::getVar('Duration')}}:</label>
                                    {!! isset($item->detail)?$item->detail->duration:0 !!}
                                    {{Vars::getVar('hours')}}</span>
                                <p>
                                    {{str_limit($item->intro, $limit = 100, $end = '...')}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-right">
                                <button class="btn btn-warning" style="width: 60%; background-color: #ffd924; border: 1px solid #ffd924;">
                                    @if(isset($item->price))
                                    {{Vars::getVar('£')}}{{sprintf('%.2f',$item->price->st_price)}}
                                    @endif
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('tour.show',['city'=>urlencode($item->sort->name),'tour'=>urlencode($item->name),'id'=>$item->id])}}" class="btn btn-warning">
                                    <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> {{Vars::getVar('Add_to_Basket')}}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
                <!-- esc Items sector end -->
            </div>
            <div class="col-md-4 main-right-side">
                @include('Web.Layouts.rightSide')


            </div>
        </div>
    </div>
</div>
@endsection