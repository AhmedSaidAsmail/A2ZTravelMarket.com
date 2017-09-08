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
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-active">
                        <i class="fa fa-users" aria-hidden="true"></i> {{ Vars::getVar("Review_Orders") }}
                        <div class="checkout-refrences-arrow"></div>
                        <div class="checkout-refrences-arrow-bg"></div>
                    </div>
                    <div class="col-md-4 col-xs-4 checkout-refrences checkout-refrences-inactive">
                        <i class="fa fa-lock"></i> {{ Vars::getVar("Secure_checkout") }}
                    </div>
                </div>
                <!-- end directory -->
                <div class="row">
                    <div class="col-md-12 review-orders-header"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ Vars::getVar("Review_Your_Orders") }}</div>
                </div>
                <div class="row" style="padding: 0px;">
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
                <div class="row" style="margin-top: 10px;">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-12">
                            <a href="{{route('home')}}" class="btn btn-primary btn-block" style="font-size: 17px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ Vars::getVar("Continue_shopping") }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="{{route('Web.checkout')}}" class="btn btn-success btn-block" style="font-size: 17px;"><i class="fa fa-check" aria-hidden="true"></i> {{ Vars::getVar("Proceed_to_Checkout") }}</a>
                        </div>
                    </div>
                    @if (isset($items))
                    @foreach ($items as $key=>$item)
                    @if(isset($item['dist_from']))
                    <div class="row review-items">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>
                                    Transfer From {{$item['dist_from']}} To {{$item['dist_to']}}
                                </h1>
                            </div>
                        </div>
                        <div class="row review-all-details">
                            <div class="col-md-4">

                                <img src="{{asset('images/Airport-Transfer.jpg')}}" style="width: 100%;" alt="">
                            </div>
                            <div class="col-md-5 review-item-details">
                                <div class="col-md-12">
                                    {{ vars::getVar("Arrival_Date") }}: {{$item['arrival_date']}}
                                </div>
                                @if(isset($item["departure_date"]))
                                <div class="col-md-12">
                                    {{ vars::getVar("Departure_Date") }}: {{$item['departure_date']}}
                                </div>
                                @endif
                                <div class="col-md-12">
                                    {{ vars::getVar("Transfer_Type") }}:{{vars::getVar($item['transfer_type'])}}
                                </div>
                                <div class="col-md-12">
                                    @if($item['transfer_times']==2)
                                    {{ vars::getVar("Go/Return") }}
                                    @else
                                    {{ vars::getVar("One_Way") }}
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ vars::getVar("Pax") }}: {{$item['pax']}}
                                </div>
                                <div class="col-md-12">
                                    <a href="{{route('remove.from.cart',['id'=>$key])}}" id="remove-cart-item"><i class="fa fa-trash" aria-hidden="true"></i> {{Vars::getVar('remove') }}</a>
                                </div>
                            </div>
                            <div class="col-md-3 review-item-price">
                                {{sprintf('%.2f',$item['price'])}} <span>{{ Vars::getVar("$") }}</span>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- tours items review -->
                    <div class="row review-items">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>
                                    {{App\MyModels\Admin\Item::find($key)->title}}
                                </h1>
                            </div>
                        </div>
                        <div class="row review-all-details">
                            <div class="col-md-4">
                                <div class="review-details-img">
                                    <img src="{{asset('images/items/thumb/'.App\MyModels\Admin\Item::find($key)->img)}}" class="img-abs-center" alt="{{App\MyModels\Admin\Item::find($key)->title}}">
                                </div>
                            </div>
                            <div class="col-md-5 review-item-details">
                                <div class="col-md-12">
                                    {{Vars::getVar('Travel_date') }}: {{$item['date']}}
                                </div>
                                <div class="col-md-12">
                                    {{Vars::getVar('Number_of_Adult') }}: {{$item['st_no']}}
                                </div>
                                <div class="col-md-12">
                                    {{Vars::getVar('Number_of_Child') }}: {{$item['sec_no']}}
                                </div>
                                <div class="col-md-12">
                                    <a href="{{route('remove.from.cart',['id'=>$key])}}" id="remove-cart-item"><i class="fa fa-trash" aria-hidden="true"></i> {{Vars::getVar('remove') }}</a>
                                </div>
                            </div>
                            <div class="col-md-3 review-item-price">
                                {{sprintf('%.2f',$item['price'])}} <span>{{ Vars::getVar("$") }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                @include('Web.Layouts.TransferForm')
                <!-- transfer form end -->
                @include('Web.Layouts.rightSide')
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
    onSelect: function () {
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