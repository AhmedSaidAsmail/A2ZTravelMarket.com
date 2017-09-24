@extends('Web.Layouts.master')
@section('meta_tags')
<title>Your Reservations</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="booking-item">
            <div class="row">
                <div class="col-md-2">
                    <label>Date / Time</label>
                </div>
                <div class="col-md-4">
                    {{date('F, d-Y',strtotime($reservation->created_at))}}
                    ({{date('h:i A',strtotime($reservation->created_at))}})

                </div>
                <div class="col-md-2">
                    <label>Transaction ID</label>
                </div>
                <div class="col-md-4">
                    {{$reservation->paymentId}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label>Tours </label>
                </div>
                <div class="col-md-4">
                    {{$reservation->tours}}
                </div>
                <div class="col-md-2">
                    <label>Total</label>
                </div>
                <div class="col-md-4">
                    {{Vars::getVar('€')}}{{$reservation->total}}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" style="margin-top: 15px;">
    <div class="col-md-9">
        @foreach($items as $item)
        <div class="cart-item">
            <div class="row cart-item-det">
                <div class="rate-this-item">
                    <form method="post" action="{{route('review.store',['id'=>$item->item_id])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="item_id" value="{{$item->item_id}}">
                        <input type="hidden" name="item_token" value="{{App\Models\Item::find($item->item_id)->remember_token}}">
                        <button class="btn btn-sm btn-default"><i class="fa fa-star"></i> Rate this tour</button>
                    </form>

                </div>
                <div class="cart-item-price">
                    {{Vars::getVar('€').$item->price}}
                </div>
                <div class="col-md-2">
                    <div class="item-card-img">
                        <img src="{{asset('images/items/thumb/'.App\Models\Item::find($item->item_id)->img)}}" class="img-abs-center" alt="">
                    </div>
                </div>
                <div class="col-md-10">
                    <h2>{{App\Models\Item::find($item->item_id)->name}}</h2>
                    <span>
                        @if(!is_null(\App\Models\Price::find($item->price_id)->language))
                        {{ucfirst(\App\Models\Price::find($item->price_id)->language)}} Tour
                        @endif
                        @if(!is_null(\App\Models\Price::find($item->price_id)->private))
                        ,Private
                        @endif
                    </span>
                    <span>{{date('F d,Y',strtotime($item->date))}} 
                        {{date('h:i A',strtotime(\App\Models\Price::find($item->price_id)->starting_time))}}</span>
                    <span>
                        {{$item->st_no}} {{App\Models\Item::find($item->item_id)->price_definition->st_price_name}}
                        @if($item->sec_no>0)
                        ,{{$item->sec_no}} {{App\Models\Item::find($item->item_id)->price_definition->sec_price_name}}
                        @endif
                        @if($item->third_no>0)
                        ,{{$item->third_no}} {{App\Models\Item::find($item->item_id)->price_definition->third_price_name}}
                        @endif

                    </span>
                </div>
            </div>
            <div class="cart-item-buttom row">
                <div class="col-md-12">
                    Book without regrets! <label>Cancel your activity for free any time up until 
                        {{date('F d,Y',strtotime($item->date." -".App\Models\Item::find($item->item_id)->cancellation." day"))}}  
                        {{date('h:i A',strtotime(\App\Models\Price::find($item->price_id)->starting_time))}}</label>
                </div>
            </div>
        </div>
        @endforeach

    </div>


</div>

@endsection