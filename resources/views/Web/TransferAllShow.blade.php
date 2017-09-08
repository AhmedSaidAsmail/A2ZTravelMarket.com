@extends('Web.Layouts.master')
@section('meta_tags')
<?php $meta = App\MyModels\Admin\Topic::where('name', 'transfer')->first() ?>
@if(!is_null($meta))
<meta name="keywords" content="{{ $meta->keywords }}" />
<meta name="description" content="{{ $meta->description }}" />
<title>{{ $meta->title }}</title>
@endif
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')
<!-- content -->
<div class="transfer-banner">
    <img class="img-abs-center" src="{{asset('images/majorca-airport-transfers.png')}}" alt="Easy Transfer">
</div>
@include('Web.Layouts.TransferInternalForm')
<div class="row transfer-sorts">
    @if(isset($lowest_taxi))
    <div class="container">
        <div class="col-md-3 text-center transfer-sort limo-taxi">
            <span>{{Vars::getVar('Taxi')}}</span>
            {{Vars::getVar('from')}} <label>{{number_format($lowest_taxi->type_limousine,2)}}{{ Vars::getVar("$") }}</label>

        </div>
        <div class="col-md-3 text-center transfer-sort limo-van">
            <span>{{Vars::getVar('Minivan')}}</span>
            {{Vars::getVar('from')}} <label>{{number_format($lowest_van->type_van,2)}}{{ Vars::getVar("$") }}</label>
        </div>
        <div class="col-md-3 text-center transfer-sort limo-coaster">
            <span>{{Vars::getVar('Coaster')}}</span>
            {{Vars::getVar('from')}} <label>{{number_format($lowest_caoster->type_coaster,2)}}{{ Vars::getVar("$") }}</label>

        </div>
        <div class="col-md-3 text-center transfer-sort limo-bus">
            <span>{{Vars::getVar('Coach')}}</span>
            {{Vars::getVar('from')}} <label>{{number_format($lowest_bus->type_bus,2)}}{{ Vars::getVar("$") }}</label>
        </div>
    </div>
    @endif
</div>
<div class="row transfer-details">
    <div class="container">
        @foreach($transfers->chunk(2) as $chunk)
        <div class="row">
            @foreach($chunk as $transfer)
            <div class="col-md-6">
                <a href="{{route('trnafsre.one',['id'=>$transfer->id])}}">
                    <div class="transfer-detail">
                        {{$transfer->dist_from}}
                        <span>{{Vars::getVar('from')}} <label>
                                {{App\Http\Controllers\Web\TransferController::getLowestPrice($transfer->type_limousine,$transfer->type_van,$transfer->type_coaster,$transfer->type_bus)}}
                                {{ Vars::getVar("$") }}</label></span>
                    </div>
                </a>

            </div>
            @endforeach

        </div>
        @endforeach

    </div>
</div>
<!-- content end -->
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
$(function () {
//Initialize Select2 Elements
    $(".select2").select2();
    $('#reservation').daterangepicker({
        startDate: new Date(),
        minDate: new Date()

    });


});
</script>
@endsection
