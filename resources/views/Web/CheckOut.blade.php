@extends('Web.Layouts.master')
@section('meta_tags')
<?php $meta = App\MyModels\Admin\Topic::where('name', 'Home')->first() ?>
<meta name="keywords" content="{{ $meta->keywords }}" />
<meta name="description" content="{{ $meta->description }}" />
<title>{{ $meta->title }}</title>
@endsection
@section('header-nav')
@include('Web.nav-menu')
@endsection
@section('content')
<div class="row intital-pages">
    <div class="container">
        <div class="row">
            <div class="col-md-8 sp-pages">
                <div class="row" style="margin-bottom: 20px; border: 1px outset #6a97ae; border-radius: 10px; overflow: hidden;">
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        <i class="fa fa-cart-plus"></i> {{ Vars::getVar("Add_to_Cart") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        <i class="fa fa-users" aria-hidden="true"></i> {{ Vars::getVar("Review_Orders") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-active">
                        <i class="fa fa-lock"></i> {{ Vars::getVar("Secure_checkout") }}
                    </div>
                </div>
                <!-- end directory -->
                <div class="row">
                    <div class="col-md-12 review-orders-header"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ Vars::getVar("Review_Your_Orders") }}</div>
                </div>
                <div class="row">
                    <div class="col-md-12 review-orders-table">
                        <div class="row review-orders-table-items review-orders-gray">
                            <div class="col-md-9">
                                {{Vars::getVar('Subtotal')}}
                            </div>
                            <div class="col-md-3">{{sprintf('%.2f',$total)}} {{ Vars::getVar("$") }}</div>
                        </div>
                        <div class="row review-orders-table-items review-orders-white">
                            <div class="col-md-9">
                                {{Vars::getVar('Deposit')}}
                            </div>
                            <div class="col-md-3">{{sprintf('%.2f',$total*$percent/100)}}</div>
                        </div>
                        <div class="row review-orders-table-items review-orders-blue">
                            <div class="col-md-9">
                                <i class="fa fa-money" aria-hidden="true"></i> {{Vars::getVar('Total')}}
                            </div>
                            <div class="col-md-3">{{sprintf('%.2f',$total)}} {{ Vars::getVar("$") }}</div>
                        </div>
                    </div>
                </div>


                <form action="{{route('finalCheckOut')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="deposit" value="{{$total*$percent/100}}">
                    <input type="hidden" name="total" value="{{$total}}">
                    <div class="box">

                        <div class="box-body sp-pages" style="border: 1px solid #000; padding-top: 20px; margin-top: 20px; background-color: #FFF;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Full_name") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input class="form-control" name="name" value="" placeholder="Enter Your Full Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Country") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <input class="form-control" name="country" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Email") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-inbox"></i>
                                            </div>

                                            <input class="form-control" type="email" name="email" value="" placeholder="Enter a valide Email Address" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Travel_Agency") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-inbox"></i>
                                            </div>

                                            <input class="form-control" type="text" name="travel_agancy" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Mobile") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" class="form-control" name="mobile" data-inputmask="'mask': ['999-999-9999 [x99999]', '+99 999 999 99999999']" data-mask required>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Hotel") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-hotel"></i>
                                            </div>
                                            <input type="text" class="form-control" name="hotel" >
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @if($transferExist==true)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Arrival_Flight_No") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-plane"></i>
                                            </div>
                                            <input type="text" class="form-control" name="arrival_flight_no" >
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Arrival_Flight_Time") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="text" class="form-control" name="arrival_flight_time" >
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @if($transferTimes==true)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Departure_Flight_No") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-plane"></i>
                                            </div>
                                            <input type="text" class="form-control" name="departure_flight_no" >
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Departure_Flight_Time") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="text" class="form-control" name="departure_flight_time" >
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Arrival_date") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar-check-o"></i>
                                            </div>
                                            <input type="text" name="arrival_date" class="form-control pull-right" id="arrival_date_2">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ Vars::getVar("Departure_date") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar-check-o"></i>
                                            </div>
                                            <input type="text" name="departure_date" class="form-control pull-right" id="departure_date_2">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-success btn-block" style="font-size: 18px;">
                                            @if($percent>0)
                                            <i class="fa fa-paypal"></i>
                                            @else
                                            <i class="fa fa-check"></i>
                                            @endif
                                            {{ Vars::getVar("CheckOut") }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>





            </div>

            <div class="col-md-4">
                @include('Web.Layouts.TransferForm')

            </div>
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
$('#arrival_date_2').Zebra_DatePicker({
    direction: true,
    format: 'Y-m-d',
    default_position: 'below',
    pair: $('#departure_date_2'),
    onSelect: function() {
        $('#departure_date_2').trigger('click');
    }
    //    disabled_dates: ['* * * 0,1,2,6']
});
$('#departure_date_2').Zebra_DatePicker({
    direction: true,
    format: 'Y-m-d',
    pair: $('#arrival_date_2'),
    default_position: 'below'
            //    disabled_dates: ['* * * 0,1,2,6']
});
</script>

@endsection