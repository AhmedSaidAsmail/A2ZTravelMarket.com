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
    <div class="container">
        <div class="col-md-3 text-center transfer-sort limo-taxi">
            <span>{{Vars::getVar('Taxi')}}</span>
            {{Vars::getVar('from')}} <label>{{number_format($transfer->type_limousine,2)}}{{ Vars::getVar("$") }}</label>
            <a href="type_limousine" class="select-transfer">{{Vars::getVar('Select')}}</a>

        </div>
        <div class="col-md-3 text-center transfer-sort limo-van">
            <span>{{Vars::getVar('Minivan')}}</span>
            {{Vars::getVar('from')}} <label>{{number_format($transfer->type_van,2)}}{{ Vars::getVar("$") }}</label>
            <a href="type_van" class="select-transfer">{{Vars::getVar('Select')}}</a>
        </div>
        <div class="col-md-3 text-center transfer-sort limo-coaster">
            <span>{{Vars::getVar('Coaster')}}</span>
            {{Vars::getVar('from')}} <label>{{number_format($transfer->type_coaster,2)}}{{ Vars::getVar("$") }}</label>
            <a href="type_coaster" class="select-transfer">{{Vars::getVar('Select')}}</a>

        </div>
        <div class="col-md-3 text-center transfer-sort limo-bus">
            <span>{{Vars::getVar('Coach')}}</span>
            {{Vars::getVar('from')}} <label>{{number_format($transfer->type_bus,2)}}{{ Vars::getVar("$") }}</label>
            <a href="type_bus" class="select-transfer">{{Vars::getVar('Select')}}</a>
        </div>
    </div>
</div>

<div class="row transfer-details" style="margin-bottom: 10px;">
    <div class="container">

        <div class="row">

            <div class="col-md-6">
                <div class="transfer-detail">
                    {{$transfer->dist_from}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="transfer-detail">
                    {{$transfer->dist_to}}
                </div>
            </div>

        </div>


    </div>
</div>
<div class="row form-under-transfer form-transfer-hide">
    <div class="container">
        <form action="{{route('add.transfer.to.cart')}}" method="post" id="form-transfer">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="dist_from" value="{{$transfer->dist_from}}">
            <input type="hidden" name="dist_to" value="{{$transfer->dist_to}}">
            <input type="hidden" name="transfer_type" value="">
            <input type="hidden" name="transfer_times" value="2">
            <div class="col-md-4">
                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon input-transfer">
                            <i class="fa fa-calendar fa-lg"></i>
                        </div>
                        <div class="transfer-input-label">
                            <label>{{Vars::getVar('When_does_your_flight_arrive?')}}</label>
                            <input type="text" name="arrival_date" class="form-control" placeholder="Outward date" id="arrival_date">
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon input-transfer">
                            <i class="fa fa-calendar fa-lg"></i>
                        </div>
                        <div class="transfer-input-label">
                            <label>{{Vars::getVar('When_does_your_flight_depart?')}}</label>
                            <input type="text" name="departure_date" class="form-control" placeholder="Return date" id="departure_date" >
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-2">
                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon input-transfer">
                            <i class="fa fa-users fa-lg"></i>
                        </div>
                        <div class="transfer-input-label">
                            <label>Passengers?</label>
                            <input name="pax" type="number" id="pax_no" value="" min="1" max="10"  class="form-control" placeholder="Adults+Childs" autocomplete="off">
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-2">
                <button class="btn btn-success btn-lg btn-block">{{Vars::getVar('Continue')}}</button>
            </div>
        </form>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" value="" id="one-way"><span>{{Vars::getVar('Only_one_way')}}</span></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="margin-bottom: 80px;"></div>
<!-- content end -->
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
