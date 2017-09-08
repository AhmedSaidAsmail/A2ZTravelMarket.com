@extends('Web.Layouts.master')
@section('meta_tags')
<title>Write a Review</title>
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')



<div class="row intital-pages" style="margin-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="review-write-container">
                    <div class="row review-write-header">
                        <div class="col-md-3">
                            <div class="review-write-img">
                                <img src="{{asset('images/items/thumb/'.$item->img)}}" alt="{{$item->title}}" class="img-abs-center">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h2>{{$item->name}}</h2>
                        </div>
                    </div>
                    <div class="row review-write-help">
                        <div class="col-md-12">
                            {{vars::getVar('Your_first-hand_experiences_really_help_other_travelers._Thanks!')}}
                        </div>
                    </div>
                    <form action="{{route('review.edit')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="item_id" value="{{$item->id}}">
                        <div class="form-group">
                            <label>{{Vars::getVar('Your_overall_rating_of_this_attraction')}}</label>
                            <input type="text" name="overall_rating" class="kv-fa rating-loading" min="1" max="5" value="0" data-size="xs" required>
                        </div>
                         <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{Vars::getVar('Full_name')}}</label>
                                    <input class="form-control" name="user_name" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{Vars::getVar('Email')}}</label>
                                    <input type="email" class="form-control" name="user_email" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{Vars::getVar('Where_are_you_from?')}}</label>
                                    <input class="form-control" name="user_country" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{Vars::getVar('Title_of_your_review')}}</label>
                            <input class="form-control" name="title" placeholder="Summarize your visit or highlight an interesting detail" required>
                        </div>
                        <div class="form-group">
                            <label>{{Vars::getVar('Your_review')}}</label>
                            <textarea class="form-control" name="review" placeholder="Tell people about your experience: your room, location, amenities?" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>{{Vars::getVar('When_did_you_travel?')}}</label>
                            <input class="form-control" name="visit_date" id="visit_date">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">{{Vars::getVar('Submit_your_review')}}</button>
                        </div>
                    </form>

                </div>


            </div>
            <div class="col-md-4">
                @include('Web.Layouts.rightSide')
            </div>

        </div>
    </div>

</div>
@endsection
@section('_extra_css')
<link rel="stylesheet" href="{{asset('kartik-star-rating/css/star-rating.css')}}" media="all" type="text/css"/>
<link rel="stylesheet" href="{{asset('kartik-star-rating/css/themes/krajee-uni/theme.css')}}" media="all" type="text/css"/>
<link rel="stylesheet" href="{{asset('css/datepicker/zebra_datepicker.min.css')}}">
@endsection
@section('_extra_js')
<script src="{{asset('kartik-star-rating/js/star-rating.js')}}" type="text/javascript"></script>
<script src="{{asset('kartik-star-rating/themes/krajee-uni/theme.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/datepicker/zebra_datepicker.min.js')}}"></script>
<script>
$(document).on('ready', function () {
    $('.kv-fa').rating({
        theme: 'krajee-fa',
        step: 1.0,
        animate: false,
        showClear: false,
        filledStar: '<i class="fa fa-star"></i>',
        emptyStar: '<i class="fa fa-star-o"></i>',
        starCaptions: {
            1: 'Terrible',
            2: 'Poor',
            3: 'Average',
            4: 'Very Good',
            5: 'Excellent'
        }
    });
});
$('#visit_date').Zebra_DatePicker({
    format: 'Y-m-d',
    default_position: 'below'
});
</script>

@endsection