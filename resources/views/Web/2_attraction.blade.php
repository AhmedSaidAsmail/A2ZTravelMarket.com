@extends('Web.Layouts.master')
@section('meta_tags')

@endsection
@section('header-nav')
<div class="row">
    <div class="img-top-title">
        <img src="{{asset('images/attraction/'.$attraction->img)}}" class="img-abs-center" alt="{{$attraction->name}}">
        <h1 class="top-title">{{ucfirst($attraction->name)}}</h1>
    </div>
</div>

@endsection
@section('content')

<div class="row">
    <div class="col-md-8">
        <h1 class="normal-header">{{ucfirst($attraction->name)}}: Tours & Tickets</h1>
        @foreach($items as $item)
        <a href="{{route('tour.show',['city'=>$attraction->sort->name,'tour'=>$item->name,'id'=>$item->id])}}" class="item-tour-link">
            <div class="row item-tour">
                <div class="col-md-4">
                    <div class="item-tour-img">
                        <img src="{{asset('images/items/thumb/'.$item->img)}}" class="img-abs-center" alt="{{$item->name}}">
                    </div>
                </div>
                <div class="col-md-8 item-tour-right">
                    <div class="tour-price-from"><span>{{Vars::getVar('From')}}</span>{{Vars::getVar('€')}}
                        {{\App\Http\Controllers\Web\AttractionController::getLowestPrice($item->id)}}</div>
                    <div class="tour-duration">
                        <i class="fa fa-clock-o"></i> <label>{{Vars::getVar('Duration')}}:</label> {{$item->duration}} {{Vars::getVar('hours')}}
                    </div>
                    <h2>{{$item->name}}</h2>
                    <div class="item-tour-rating">
                        {{ App\Http\Controllers\ReviewController::getRateStar(App\Http\Controllers\ReviewsRateCalculate::calc($item->id,'overall_rating')) }}
                        {{count($item->reviews()->where('confirm',1)->get())}} {{Vars::getVar('Reviews')}}
                    </div>
                    <span class="item-tour-intro">
                        {!! \Illuminate\Support\Str::limit($item->intro, $limit = 147, $end = '...') !!}
                    </span>
                </div>
            </div> 
        </a>

        @endforeach
        @if($moreAttraction)
        <div class="row text-center see-all">
            <a class="btn btn-info" href="{{route('attraction.show.all',['id'=>$attraction->id])}}">
                See all tours & things to do in {{$attraction->sort->name}} {{$attraction->name}}</a>
        </div>
        @endif
    </div>
    <div class="col-md-4">
        <h1 class="normal-header">Top sights in {{$attraction->sort->name}}</h1>
        @foreach($topCityAttractions as $topCityAttraction)
        <div class="img-right-side">
            <a href="{{route('attraction.show',['id'=>$topCityAttraction->id])}}">
                <img src="{{asset('images/attraction/'.$topCityAttraction->img)}}" class="img-abs-center" alt="{{$topCityAttraction->name}}">
                <span>{{$topCityAttraction->name}}</span>
                <p>{{count($topCityAttraction->items)}} activities</p>
            </a>
        </div>
        @endforeach
    </div>
</div>

<div class="row attraction-city-show">
    <div class="col-md-12">
        <div class="attraction-city-img">
            <img class="img-panorama" src="{{asset('images/sorts/'.$attraction->sort->img)}}" alt="{{$attraction->sort->name}}">
            <div class="img-panorama-text-cenetr">
                <span>{{ucfirst($attraction->sort->name)}}</span>
                <button class="btn btn-info">See all {{count($attraction->sort->items)}} tours & tickets</button>
            </div>
        </div>
    </div>

</div>

@endsection
