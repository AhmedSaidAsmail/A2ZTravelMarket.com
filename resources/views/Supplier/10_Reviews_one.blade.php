@extends('Supplier.Layouts.Layout_Basic')
@section('title','Main Category Panel')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1> Review <small>Summery</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel </a></li>
            <li><a href="#">Review : {{$review->id}}</a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="row reviews-summary-container">
                    <div class="row reviews-summary">
                        <div class="col-md-4">
                            <span class="reviews-summary-title">Overall rating</span>
                            <div class="overall-rating">
                                {{\App\Http\Controllers\ReviewController::getRateStar($review->overall_rating)}}
                                {{$review->overall_rating}} / 5
                            </div>
                        </div>
                        <div class="col-md-8 reviews-summary-all">
                            <span class="reviews-summary-title">Review summary</span>
                            <div class="row">
                                <div class="col-md-3">
                                    Service
                                </div>
                                <div class="col-md-4">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{$review->service_rating/5*100}}%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{$review->service_rating}}/5
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Organization
                                </div>
                                <div class="col-md-4">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{$review->organization_rating/5*100}}%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{$review->organization_rating}}/5
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Value for money
                                </div>
                                <div class="col-md-4">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{$review->value_rating/5*100}}%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{$review->value_rating}}/5
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Safety
                                </div>
                                <div class="col-md-4">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{$review->safety_rating/5*100}}%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{$review->safety_rating}}/5
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row" style="margin: 10px 0px;">
            <div class="col-md-9" style="background-color: #FFF;">
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
                                reviewed by <span>{{$review->customer->name}} – {{$review->customer->country}}</span>
                            </div>
                        </div>
                        <span class="review-show-date">{{date('F d, Y',strtotime($review->visit_date))}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- end content -->
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
@endsection
