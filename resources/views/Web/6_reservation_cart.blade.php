@extends('Web.Layouts.master')
@section('meta_tags')
<title>Your Cart</title>
@endsection

@section('content')

<h1 class="cart-header">Hooray, you’ve successfully added 1 item to your cart.</h1>
<h2 class="cart-header">Only 2 more steps to go!</h2>
<span class="cart-warn"><i class="fa fa-clock-o"></i> Once you add an activity to your cart, we will save your spot for 60 minutes.</span>

<div class="row" style="margin-top: 15px;">
    <div class="col-md-8">
        @foreach($items as $key=>$item)
        <div class="cart-item">
            <div class="row cart-item-det">
                <div class="cart-item-remove">
                    <a href="{{route('reservation.cart.remove',['id'=>$key])}}"><i class="fa fa-times"></i></a>
                </div>
                <div class="cart-item-price">
                    {{Vars::getVar('€').$item['price']}}
                </div>
                <div class="col-md-2">
                    <div class="item-card-img">
                        <img src="{{asset('images/items/thumb/'.App\Models\Item::find($item['item'])->img)}}" class="img-abs-center" alt="">
                    </div>
                </div>
                <div class="col-md-10">
                    <h2>{{App\Models\Item::find($item['item'])->name}}</h2>
                    <span>
                        @if(!is_null(\App\Models\Price::find($item['price_id'])->language))
                        {{ucfirst(\App\Models\Price::find($item['price_id'])->language)}} Tour
                        @endif
                        @if(!is_null(\App\Models\Price::find($item['price_id'])->private))
                        ,Private
                        @endif
                    </span>
                    <span>{{date('F d,Y',strtotime($item['date']))}} 
                        {{date('h:i A',strtotime(\App\Models\Price::find($item['price_id'])->starting_time))}}</span>
                    <span>
                        {{$item['st_no']}} {{App\Models\Item::find($item['item'])->price_definition->st_price_name}}
                        @if($item['sec_no']>0)
                        ,{{$item['sec_no']}} {{App\Models\Item::find($item['item'])->price_definition->sec_price_name}}
                        @endif
                        @if($item['third_no']>0)
                        ,{{$item['third_no']}} {{App\Models\Item::find($item['item'])->price_definition->third_price_name}}
                        @endif

                    </span>
                </div>
            </div>
            <div class="cart-item-buttom row">
                <div class="col-md-12">
                    Book without regrets! <label>Cancel your activity for free any time up until 
                        {{date('F d,Y',strtotime($item['date']." -".App\Models\Item::find($item['item'])->cancellation." day"))}}  
                        {{date('h:i A',strtotime(\App\Models\Price::find($item['price_id'])->starting_time))}}</label>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="col-md-4">
        <div class="cart-all-total">
            <span class="cart-header-total">Total ({{$qty}} items):<label>{{Vars::getVar('€').$total}}</label></span>
            <span>No additional fees.</span>
            <a href="{{route('reservation.checkout')}}" class="btn btn-info btn-block">Checkout</a>
            <div class="cart-all-bottom">
                <a href="{{route('customer.register')}}">Create an account</a> or <a href="#" id="login_now">log in</a>
                <span>for faster checkout.</span>
            </div>
        </div>
    </div>
</div>

@endsection