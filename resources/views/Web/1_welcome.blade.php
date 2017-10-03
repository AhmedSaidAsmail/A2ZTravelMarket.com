@extends('Web.Layouts.master')
@section('meta_tags')
<?php $meta = App\MyModels\Admin\Topic::where('name', 'Home')->first() ?>
@if(!is_null($meta))
<meta name="keywords" content="{{ $meta->keywords }}" />
<meta name="description" content="{{ $meta->description }}" />
<title>{{ $meta->title }}</title>
@endif
@endsection
@section('header-nav')
<div class="row" style="position: relative;">
    <div class="quick-search">
        <form method="get" action="#" id="search_form_dest">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="sp-eddition-2">
                            <label>Where are you going?</label>
                            <input type="text" name="search" class="form-control" data-get="{{route('home.search')}}" id="attraction_search" autocomplete="off">
                            <input type="text" name="search-done" value="" style="display: none;" id="search_done" required>
                            <ul class="search-results">

                            </ul>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group sp-eddition">
                            <div class="input-group-addon">
                                <label>from</label>
                                <i class="fa fa-calendar-o fa-lg"></i>
                            </div>
                            <input name="from" type="text" class="form-control" id="tour_from">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group sp-eddition">
                            <div class="input-group-addon">
                                <label>to</label>
                                <i class="fa fa-calendar-o fa-lg"></i>
                            </div>
                            <input name="to" type="text" class="form-control" id="tour_to">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-info btn-block"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </form>
    </div>
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
<div id="top_destetion">
    <h1>Top Destinations</h1>
    <div id="top_attraction_container">
        <!-- to append show more items -->
        @foreach($topCitis->chunk(4) as $chunks)
        <div class="row row-img-holder">
            @foreach($chunks as $topCity)
            <div class="col-md-3 col-img-holder" id="top_dest">
                <div class="col-md-3-img">
                    <a href="{{route('city.show',['id'=>$topCity->id])}}">
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
        <button class="btn btn-info" id="top_dest_show" data-start="12">Show more destinations</button>
    </div>
    @endif
</div> 
<div id="top_attraction">
    <h1>Top Attractions</h1>
    <div id="top_attraction_container">
        <!-- to append show more items -->
        @foreach($topAttractions->chunk(4) as $chunks)
        <div class="row row-img-holder">
            @foreach($chunks as $topAttraction)
            <div class="col-md-3 col-img-holder" id="top_attr">
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
        <button class="btn btn-info" data-start="12" id="top_attr_show">Show more attractions</button>
    </div>
    @endif
</div>  


@endsection
@section('_extra_css')
<link rel="stylesheet" href="{{asset('css/datepicker/zebra_datepicker.min.css')}}">
@endsection
@section('_extra_js')
<script type="text/javascript" src="{{asset('js/datepicker/zebra_datepicker.min.js')}}"></script>
<script>
$('#tour_from').Zebra_DatePicker({
    direction: true,
    format: 'Y-m-d',
    default_position: 'below',
    pair: $('#tour_to'),
    onSelect: function () {
        var label = $(this).closest('.input-group').find('label');
        label.addClass('small');
        $('#tour_to').trigger('click');
    }
});
$('#tour_to').Zebra_DatePicker({
    direction: true,
    format: 'Y-m-d',
    default_position: 'below',
    onSelect: function () {
        var label = $(this).closest('.input-group').find('label');
        label.addClass('small');
    }
});
</script>
@endsection