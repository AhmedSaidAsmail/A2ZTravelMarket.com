@extends('Web.Layouts.master')
@section('meta_tags')

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="main-item-title">{{$item->name}}</h1>
        <div class="item-tour-rating">
            {{ App\Http\Controllers\ReviewController::getRateStar(App\Http\Controllers\ReviewsRateCalculate::calc($item->id,'overall_rating')) }}
            <span class="review-rate">{{App\Http\Controllers\ReviewsRateCalculate::calc($item->id,'overall_rating')}} / 5</span>
            <span class="reviews-count">{{count($item->reviews()->where('confirm',1)->get())}} {{Vars::getVar('Reviews')}} </span>
            <span class="main-item-duration"><i class="fa fa-clock-o"></i> 
                <label>{{Vars::getVar('Duration')}}:</label> {{$item->duration}} {{Vars::getVar('hours')}}</span>
        </div>

        <div class="main-item-img">
            <img src="{{asset('images/items/'.$item->img)}}" class="img-abs-center" alt="">
        </div>
    </div>
</div>
<div class="row" style="margin-top: 15px;">
    <div class="col-md-8">
        <div class="row item-main">
            <div class="item-main-intro">
                {{$item->intro}}
            </div>
            <span class="item-main-glance">At a glance</span>
            <div class="row glance-item">
                <div class="col-md-6 glance-left-side">
                    <i class="fa fa-mobile fa-2x"></i> <span>Printed or mobile voucher accepted</span>
                </div>
            </div>
            <div class="row glance-item">
                <div class="col-md-6 glance-left-side">
                    <i class="fa fa-user fa-lg"></i> <span>Live Guide</span>
                </div>
                <div class="col-md-6 text-right glance-right-side">
                    <?php $languages = $item->price()->distinct()->where('language', '!=', 'null')->get(['language']) ?>
                    {{$languages->implode('language', ', ')}}


                </div>
            </div>
            <div class="row glance-item">
                <div class="col-md-6 glance-left-side">
                    <i class="fa fa-bus fa-lg"></i> <span>Pick-up service</span>
                </div>
            </div>
            <div class="row glance-item">
                <div class="col-md-6 glance-left-side">
                    <i class="fa fa-credit-card fa-lg"></i> <span>Cancellation policy</span>
                </div>
                <div class="col-md-6 text-right glance-right-side">
                    Cancel up to {{$item->cancellation}} days in advance for a full refund
                </div>
            </div>
        </div>
        <div class="row item-select-date">
            <div class="row">
                <div class="col-md-12">
                    <span class="select-date-title">Select date and participants:</span>
                </div>
            </div>
            <form method="post" action="{{route('tour.get.prices',['id'=>$item->id])}}" id="choose-plane">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-4" id="datepicker_container">

                        <div class="form-group">
                            <div class="input-group sp-eddition">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar-o fa-lg"></i>
                                </div>
                                <input name="date" value="{{date('M d,Y')}}" type="text" class="form-control" id="tour_date" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="select-travelers-hidden select-off">
                            <i class="fa fa-caret-down price-toggle price-toggle-down"></i>
                            <div class="details-holder">
                                <i class="fa fa-user"></i>

                                <span id="st_no">{{$item->price_definition->st_price_name}} x <label>1</label></span>
                                <span id="sec_no" class="alternative-sort">, {{$item->price_definition->sec_price_name}} x <label>0</label></span>
                                @if(!is_null($item->price_definition->third_price_name))
                                <span id="third_no" class="alternative-sort">, {{$item->price_definition->third_price_name}} x <label></label></span>
                                @endif

                            </div>
                            <div class="select-travelers-holder">
                                <div class="row">
                                    <div class="col-md-9">{{$item->price_definition->st_price_name}}
                                        <span>{!! (!is_null($item->price_definition->st_price_def))?'('.$item->price_definition->st_price_def.')':null !!}</span>

                                    </div>
                                    <div class="col-md-2 select-input">
                                        <i class="fa fa-plus fa-plus-sp"></i>
                                        <i class="fa fa-minus fa-minus-sp"></i>
                                        <input name="st_no" type="number"  value="1" min="1" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">{{$item->price_definition->sec_price_name}}
                                        <span>{!! (!is_null($item->price_definition->sec_price_def))?'('.$item->price_definition->sec_price_def.')':null !!}</span>
                                    </div>
                                    <div class="col-md-2 select-input">
                                        <i class="fa fa-plus fa-plus-sp"></i>
                                        <i class="fa fa-minus fa-minus-sp"></i>
                                        <input name="sec_no" type="number"  value="0" min="0" class="form-control">
                                    </div>
                                </div>
                                @if(!is_null($item->price_definition->third_price_name))
                                <div class="row">
                                    <div class="col-md-9">{{$item->price_definition->third_price_name}}
                                        <span>{!! (!is_null($item->price_definition->third_price_def))?'('.$item->price_definition->third_price_def.')':null !!}</span></div>
                                    <div class="col-md-2 select-input">
                                        <i class="fa fa-plus fa-plus-sp"></i>
                                        <i class="fa fa-minus fa-minus-sp"></i>
                                        <input name="third_no"  type="number"  value="0" min="0" class="form-control">
                                    </div>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-info btn-block">Show Availability</button>
                    </div>
                </div>
            </form>

        </div>
        <!-- loading section -->
        <div class="row ftech-data-loading">
            <img src="{{asset('images/loading6_230x230-cooler.gif')}}" alt="fetech data">
        </div>

        <div id="all-plane-prices">

        </div>

        <!-- loading section end -->
        <div class="row item-highlights">
            <div class="col-md-12">
                @if(count($item->highlights)>0)
                <h2>Highlights</h2>
                <ul class="highlights">
                    @foreach($item->highlights as $highlight)
                    <li>{{$highlight->txt}}</li>
                    @endforeach
                </ul>
                @endif
                @if(isset($item->exploration->txt))
                <h2>Full description</h2>
                {!! $item->exploration->txt !!}
                @endif
                <h2>What’s included</h2>
                <ul>
                    @if(count($item->inclusion)>0)
                    @foreach($item->inclusion as $inclusion)
                    <li><i class="fa fa-check item-included"></i> {{$inclusion->txt}}</li>
                    @endforeach
                    @endif
                    @if(count($item->exclusion)>0)
                    @foreach($item->exclusion as $exclusion)
                    <li><i class="fa fa-times item-not-included"></i> {{$exclusion->txt}}</li>
                    @endforeach

                    @endif
                </ul>
                @if(count($item->additional)>0)
                <h2>Know before you go</h2>
                <ul>
                    @foreach($item->additional as $additional)
                    <li>{{$additional->txt}}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        <!-- reviews -->
        <div class="row reviews-summary-container">
            <h2>Reviews <span>(1 Reviews)</span></h2>
            <div class="row reviews-summary">
                <div class="col-md-4">
                    <span class="reviews-summary-title">Overall rating</span>
                    <div class="overall-rating">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        3 / 5
                    </div>
                    <span class="reviews-summary-based">based on 1 reviews</span>
                </div>
                <div class="col-md-8 reviews-summary-all">
                    <span class="reviews-summary-title">Review summary</span>
                    <div class="row">
                        <div class="col-md-4">
                            Service
                        </div>
                        <div class="col-md-4">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                     aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            3/5
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Organization
                        </div>
                        <div class="col-md-4">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                     aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            3/5
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Value for money
                        </div>
                        <div class="col-md-4">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                     aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            3/5
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Safety
                        </div>
                        <div class="col-md-4">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                     aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            3/5
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end reviews -->
        <!-- all review item show -->
        <div class="row item-all-reviews">
            <div class="row item-review-header">
                <div class="col-md-8">
                    Sort by:
                    <div class="review-sort-by">
                        Rating
                        <i class="fa fa-caret-down"></i>
                        <i class="fa fa-caret-up"></i>
                    </div>
                    <div class="review-sort-by">
                        Date
                        <i class="fa fa-caret-down"></i>
                        <i class="fa fa-caret-up"></i>
                    </div>
                </div>
                <div class="col-md-1" style="padding-right: 0px; padding-left: 0px; padding-top: 5px;">
                    Filter by:

                </div>
                <div class="col-md-3">
                    <select class="form-control">
                        <option value="">See all reviews</option>
                    </select>
                </div>
            </div>

            <div class="review-show">

                <div class="row">
                    <div class="col-md-9">
                        <h2>"The pyramids are great.i enjoyed it"</h2>
                        <div class="review-show-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>

                        </div>
                        <div class="review-show-msg">
                            I recommend strongly this guide for all who prefer a friendly tour with a professional explanations of the Egyptian history, as we were lucky with our excellent guide Akram. Thank you!
                        </div>
                        <div class="review-show-owner">
                            reviewed by <span>Ahmed – Egypt</span>
                        </div>
                    </div>
                    <span class="review-show-date">September 3, 2017</span>
                    <div class="review-helpfull">
                        Was this helpful? <a href="#" class="btn btn-default">yes</a>
                    </div>
                </div>
            </div>
            <div class="review-show">

                <div class="row">
                    <div class="col-md-9">
                        <h2>"The pyramids are great.i enjoyed it"</h2>
                        <div class="review-show-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>

                        </div>
                        <div class="review-show-msg">
                            I recommend strongly this guide for all who prefer a friendly tour with a professional explanations of the Egyptian history, as we were lucky with our excellent guide Akram. Thank you!
                        </div>
                        <div class="review-show-owner">
                            reviewed by <span>Ahmed – Egypt</span>
                        </div>
                    </div>
                    <span class="review-show-date">September 3, 2017</span>
                    <div class="review-helpfull">
                        Was this helpful? <a href="#" class="btn btn-default">yes</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- all reviews item end -->
        <div class="row see-all-review-button">
            <div class="col-md-12 text-center">
                <button class="btn btn-info">See more reviews</button>
            </div>
        </div>

    </div>
    <div class="col-md-4 right-side-tour-holder">
        <div class="text-right right-side-tour">
            {!! \App\Http\Controllers\Web\itemsController::getDiscountSign($item->id) !!}
            <span>from</span>
            <span class="total-right">
                {!! \App\Http\Controllers\Web\itemsController::getLowestPrice($item->id) !!}
            </span>
            <span>per person</span>
            <button class="btn btn-info" id="go-to-book">Book now</button>
        </div>
        <ul>
            <li><a href=""><i class="fa fa-envelope"></i> Ask a question</a></li>
            <li><a href=""><i class="fa fa-heart"></i> Add to wishlist</a></li>
        </ul>
    </div>
</div>
<h2 class="item-addetional-header">You might also like...</h2>
<div class="row item-addetional">
    @foreach($recommended as $itemRec)
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
    @endforeach


</div>


@endsection
@section('_extra_css')
<link rel="stylesheet" href="{{asset('css/datepicker/zebra_datepicker.min.css')}}">
@endsection
@section('_extra_js')
<script type="text/javascript" src="{{asset('js/datepicker/zebra_datepicker.min.js')}}"></script>
<script type="text/javascript" src="js/min.js"></script>
<script>

$('#tour_date').Zebra_DatePicker({
    direction: true,
    format: 'M d,Y',
    strict: false,
    default_position: 'below',
    onSelect: function () {
        var label = $(this).closest('.input-group').find('label');
        label.addClass('small');
    }
});
</script>
@endsection