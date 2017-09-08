@extends('Web.Layouts.master')
@section('meta_tags')
<title>{{$item->title}}</title>
<meta name="keywords" content="{{ $item->keywords }}" />
<meta name="description" content="{{ $item->description }}" />
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')

<!-- dynamic content -->
<div class="row intital-pages">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row tour-short-details">
                    <h1>{{$item->title}}</h1>
                    <div class="col-md-7">

                        <div class="row item-tripadvisor-icon">
                            <div class="row">
                                <div class="col-md-3 col-lg-2 col-xs-3 col-sm-3" style="margin-top: 0px;">
                                    <div class="fb-like" data-href="http://www.hurghadawonders.com" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xs-3 col-sm-3">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://hurghadawonders.com" data-count="none">Tweet</a>
                                </div>
                                <div class="col-md-4 col-lg-3 google-api">
                                    <script src="https://apis.google.com/js/platform.js" async defer></script>
                                    <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/113067422417563827751" data-rel="publisher"></div>
                                </div>
                                <div class="col-md-2 col-xs-3 col-sm-3"><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <td>{{Vars::getVar('Availability')}}</td>
                                    <td>
                                        @if(isset($item->detail))
                                        <?php
                                        if (count(unserialize($item->detail->availability)) >= 7) {
                                            $days = Vars::getVar('every_day');
                                        } else {
                                            $days = implode(" , ", unserialize($item->detail->availability));
                                        }
                                        echo $days;
                                        ?>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{Vars::getVar('Pickup_Time')}}</td>
                                    <td>{{isset($item->detail)?date('h:i A',strtotime($item->detail->started_at)):""}}</td>
                                </tr>
                                <tr>
                                    <td>{{Vars::getVar('Return_Time')}}</td>
                                    <td>{{isset($item->detail)?date('h:i A',strtotime($item->detail->ended_at)):""}}</td>
                                </tr>
                                <tr>
                                    <td>{{Vars::getVar('Duration')}}</td>
                                    <td>{{isset($item->detail)?$item->detail->duration:""}} {{Vars::getVar('hours_approximately')}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="tour-details-img">
                            <img class="img-abs-center" src="{{asset('images/items/'.$item->img)}}" alt="">
                        </div>

                    </div>
                </div>
                <!-- tour Details -->
                <div class="row item-details-container">



                    <ul class="nav nav-tabs item-details-tab">
                        <li class="active">
                            <a data-toggle="tab" href="#home">
                                <span class="glyphicon glyphicon-stats" ></span> {{Vars::getVar('Itinerary')}}</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu1">
                                <span class="glyphicon glyphicon-picture"></span> {{Vars::getVar('Gallery')}}</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu2">
                                <span class="fa fa-comment"></span> {{Vars::getVar('Reviews')}} 
                                <span class="fa-stack" style="font-size: 9px; color: #777777;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <strong class="fa-stack-1x fa-inverse">
                                        {{$item->reviews()->where('confirm',1)->count()}}
                                    </strong>
                                </span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content item-tab-style" >
                        <div id="home" class="tab-pane fade in active">
                            <h3>{{Vars::getVar('Highlights')}}</h3>
                            <h3><b>{{$item->title}}</b></h3>
                            @if(isset($item->exploration->txt))
                            {!! $item->exploration->txt !!}
                            @endif
                            <div class="row small-gallery">
                                <div class="small-gallery-label">
                                    <span class="small-gallery-label-span">
                                        <span class="glyphicon glyphicon-picture"></span> {{Vars::getVar('Small_Gallery')}}</span>
                                </div>

                                @if(isset($item->itemsgallrie))
                                @foreach($item->itemsgallrie->slice(0,4) as $img)
                                <div class="col-md-3">
                                    <div class="small-gallery-img">
                                        <a href="">
                                            <img class="img-abs-center" src="{{asset('images/gallery/thumb/'.$img->img)}}" alt="{{$item->title}}">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @endif

                            </div>


                            @if(count($item->inclusion)>0)
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                                    </span>
                                    {{Vars::getVar('Our_Service_includes')}}</h3>
                                <ul class="tour-multi-daetails">
                                    @foreach($item->inclusion as $inclusion)
                                    <li>{{$inclusion->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if(count($item->exclusion)>0)
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                                    </span> {{Vars::getVar('Our_Service_Not_includes')}}</h3>
                                <ul class="tour-multi-daetails">
                                    @foreach($item->exclusion as $exclusion)
                                    <li>{{$exclusion->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if(count($item->additional)>0)
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-star fa-stack-1x fa-inverse"></i>
                                    </span> {{Vars::getVar('Recommendation')}}</h3>
                                <ul class="tour-multi-daetails">
                                    @foreach($item->additional as $additional)
                                    <li>{{$additional->txt}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="row">
                                <h3 class="item-details-label-header">
                                    <span class="fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-info fa-stack-1x fa-inverse"></i>
                                    </span> {{Vars::getVar('Do_you_need_more_details?_call_or_email_us')}}</h3>
                                <ul class="tour-multi-daetails">
                                    <li>{{Vars::getVar('Phone')}}</li>
                                    <li>{{Vars::getVar('email@email.com')}}</li>
                                </ul>
                            </div>

                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h3>Menu 1</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="row review-show-header">
                                <div class="col-md-9">
                                    <h2 class="reviews-tour-header">
                                        {{$item->name}} {{Vars::getVar('Reviews')}} 
                                        <span>{{App\Http\Controllers\Web\ReviewsRateCalculate::calc($item->id,'overall_rating')}} / 5 based on 182 customer reviews</span></h2>
                                </div>
                                <div class="col-md-3 text-right">
                                    <a href="{{route('review.store',['id'=>$item->id])}}" class="btn btn-success">{{Vars::getVar('Write_Review')}}</a>
                                </div>
                            </div>
                            @foreach($item->reviews()->where('confirm',1)->get() as $review)
                            <div class="review-show">

                                <div class="row">
                                    <div class="col-md-9">
                                        <h2>"{{$review->title}}"</h2>
                                        <div class="review-show-rate">
                                       {{ App\Http\Controllers\ReviewController::getRateStar($review->overall_rating) }}

                                        </div>
                                        <div class="review-show-msg">
                                            {{$review->review}}
                                        </div>
                                        <div class="review-show-owner">
                                            reviewed by <span>{{$review->user_name}} – {{$review->user_country}}</span>
                                        </div>
                                    </div>
                                    <span class="review-show-date">{{date('F d, Y',strtotime($review->visit_date))}}</span>
                                    <div class="review-helpfull">
                                        Was this helpful? <a href="#" class="btn btn-default">yes</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>

                    </div>
                </div>
                <!-- tour Deatils end -->
            </div>
            <!-- content right side -->
            <div class="col-md-4" style="padding-left: 30px;">
                <!-- booking form -->
                @include('Web.Layouts.BookingForm')
                <!-- booking form end -->
                @include('Web.Layouts.rightSide')

            </div>
            <!-- content right side end -->
        </div>
    </div>
</div>
<!-- last Welcome start -->
@endsection
@section('extra-plugged-in')
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=184060755364562";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');</script>
@endsection
@section('_extra_js')
<script type="text/javascript" src="{{asset('js/datepicker/zebra_datepicker.min.js')}}"></script>
<script>

    var daysOff;
    var inputlink = $('.daysoff').attr('data');
    $.ajax({
        type: "get",
        url: inputlink,
        dataType: 'json',
        success: function (response) {

            daysOff = response;
            if (daysOff !== null) {
                $(function () {
                    $('#booking_date').Zebra_DatePicker({
                        direction: true,
                        format: 'Y-m-d',
                        default_position: 'below',
                        disabled_dates: ['* * * ' + daysOff]
                    });
                });
            } else {
                $(function () {
                    $('#booking_date').Zebra_DatePicker({
                        direction: true,
                        format: 'Y-m-d',
                        default_position: 'below'
                    });
                });
            }

        }
    });
</script>
@endsection
@section('_extra_css')
<link rel="stylesheet" href="{{asset('css/datepicker/zebra_datepicker.min.css')}}">
@endsection