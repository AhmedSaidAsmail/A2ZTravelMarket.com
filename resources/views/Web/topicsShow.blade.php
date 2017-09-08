@extends('Web.Layouts.master')
@section('meta_tags')
<title>{{ $topic->title }}</title>
<meta name="keywords" content="{{ $topic->keywords }}">
<meta name="description" content="{{ $topic->description }}">
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')



<div class="row intital-pages" style="margin-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <ul class="list-inline directory">
                        <li><a href="">{{ Vars::getVar("Home") }}<span class="glyphicon glyphicon-chevron-right" style="font-size: 10px;"></span></a></li>
                        <li><a href="">{{Vars::getVar('Articles')}} <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <li><a href="">{{$topic->name}}</a>
                    </ul>
                    <h1>{{$topic->title}}</h1>
                </div>
                @if($topic->Topics_text)
                {!! $topic->Topics_text->txt !!}
                @endif

            </div>
            <div class="col-md-4">
                @include('Web.Layouts.rightSide')
            </div>

        </div>
    </div>

</div>
@endsection
@section('_extra_css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
@endsection
@section('_extra_js')
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<!-- date Range -->
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
$(function() {
//Initialize Select2 Elements
    $(".select2").select2();
    $('#reservation').daterangepicker({
        startDate: new Date(),
        minDate: new Date()

    });


});
</script>
@endsection