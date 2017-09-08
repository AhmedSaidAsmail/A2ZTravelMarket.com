@extends('Web.Layouts.master')
@section('meta_tags')
<title>{{ $category->title }}</title>
<meta name="keywords" content="{{ $category->keywords }}">
<meta name="description" content="{{ $category->description }}">
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')

<div class="row intital-pages">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="sort-deatils">
                    <img class="img-abs-center" src="{{asset('images/sorts/'.$category->img)}}" alt="{{$category->title}}">
                    <div class="sort-info">
                        <h1>
                            <i class="fa fa-map-marker"></i>
                            {{$category->title}}</h1>
                        <p>
                            {{$category->txt}}
                        </p>
                    </div>
                </div>
                <div class="items">
                    @foreach($category->items as $item)
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
                </div>

            </div>
            <!-- content right side -->
            <div class="col-md-4" style="padding-left: 30px;">
                <!-- transfer form -->
                @include('Web.Layouts.TransferForm')
                <!-- transfer form end -->
                @include('Web.Layouts.rightSide')
            </div>
            <!-- content right side end -->
        </div>
    </div>
</div>

@endsection
@section('_extra_css')
<link rel="stylesheet" href="{{asset('css/datepicker/zebra_datepicker.min.css')}}">
@endsection
@section('_extra_js')
<script type="text/javascript" src="{{asset('js/datepicker/zebra_datepicker.min.js')}}"></script>
<script>
$('#arrival_date').Zebra_DatePicker({
    direction: true,
    format: 'Y-m-d',
    default_position: 'below',
    pair: $('#departure_date'),
    onSelect: function() {
        $('#departure_date').trigger('click');
    }
    //    disabled_dates: ['* * * 0,1,2,6']
});
$('#departure_date').Zebra_DatePicker({
    direction: true,
    format: 'Y-m-d',
    pair: $('#arrival_date'),
    default_position: 'below'
            //    disabled_dates: ['* * * 0,1,2,6']
});
</script>

@endsection