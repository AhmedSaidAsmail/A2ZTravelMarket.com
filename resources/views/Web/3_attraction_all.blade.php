@extends('Web.Layouts.master')
@section('meta_tags')

@endsection
@section('content')

<h1 class="all-tour-title">{{$attraction->name}} <span>{{count($items)}} activities found</span></h1>
<div class="row">
    <div class="col-md-3">
        <form method="get" action="{{route('attraction.show.available',['id'=>$attraction->id])}}">
            <div class="left-side-form">
                <span class="form-header">
                    Enter your dates to find available activities:
                </span>
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
                <button class="btn btn-info btn-block">Check Availability</button>
            </div> 
        </form>

    </div>
    <div class="col-md-9">
        @foreach($items as $item)
        <a href="{{route('tour.show',['city'=>$attraction->sort->name,'tour'=>$item->name,'id'=>$item->id])}}" class="item-tour-link">
            <div class="row item-tour" id="item-tour">
                <div class="col-md-4">
                    <div class="item-tour-img">
                        <img src="{{asset('images/items/thumb/'.$item->img)}}" class="img-abs-center" alt="{{$item->name}}">
                    </div>
                </div>
                <div class="col-md-8 item-tour-right">
                    <div class="tour-price-from"><span>{{Vars::getVar('From')}}</span>
                        {!! \App\Http\Controllers\Web\ItemsController::getLowestPrice2($item->id) !!}</div>
                    <div class="tour-duration">
                        <i class="fa fa-clock-o"></i> <label>{{Vars::getVar('Duration')}}:</label> {{$item->duration}} {{Vars::getVar('hours')}}
                    </div>
                    <h2>{{$item->name}}{{$item->id}}</h2>
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
        <div class="row text-center see-all">
            <button class="btn btn-info" id="show-more" data-start="10">Show <span>10</span> more activities</button>
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