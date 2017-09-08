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
                <div class="row write-success">
                    @if(session('success'))
                    <i class="fa fa-check"></i> {{Vars::getVar(session('success'))}}
                    @endif
                </div>
                <div class="row reviews-all">
                    @foreach($reviews as $review)
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
            <div class="col-md-4">
                @include('Web.Layouts.rightSide')
            </div>

        </div>
    </div>

</div>
@endsection
@section('_extra_css')

@endsection
@section('_extra_js')


@endsection