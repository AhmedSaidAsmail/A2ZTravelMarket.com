@extends('Web.Layouts.master')
@section('meta_tags')
<title>Secure Checkout</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-7 checkout-form">
        <form method="post" action="{{route('reservation.proceedPayment')}}">
            {{csrf_field()}}
            @if(isset($customer))
            <input type="hidden" name="customer_id" value="{{$customer->id}}">
            @endif
            <input type="hidden" name="total" value="{{$total}}">
            <section>
                <h1>
                    <span class="fa-stack">
                        <i class="fa fa-stack-2x fa-circle"></i>
                        <span class="fa fa-stack-1x fa-inverse">1</span>
                    </span>
                    Billing Details
                </h1>
                <div class="row input-group-sp">
                    <div class="col-md-3">Full name</div>
                    <div class="col-md-9"><input type="text" name="name" value="{{isset($customer)?$customer->name:""}}" class="form-control" required></div>
                </div>
                <div class="row input-group-sp">
                    <div class="col-md-3">Email</div>
                    <div class="col-md-9">
                        <input type="text" name="email" value="{{isset($customer)?$customer->email:""}}" class="form-control" required>
                        @if(isset($customer))
                        <span class="input-note">Confirmation and tickets will be sent to {{$customer->email}}</span>
                        @endif

                    </div>
                </div>
                <div class="row input-group-sp">
                    <div class="col-md-3">Country</div>
                    <div class="col-md-9"><input type="text" name="country" value="{{isset($customer)?$customer->country:""}}" class="form-control" required></div>
                </div>
                <div class="row input-group-sp">
                    <div class="col-md-3">Mobile phone</div>
                    <div class="col-md-9">
                        <input type="text" name="phone" value="{{isset($customer)?$customer->phone:""}}" class="form-control" required>
                        <span class="input-note">Provide your mobile number with the country code.</span>
                    </div>
                </div>
            </section>
            <section>
                <h1>
                    <span class="fa-stack">
                        <i class="fa fa-stack-2x fa-circle"></i>
                        <span class="fa fa-stack-1x fa-inverse">2</span>
                    </span>
                    Select payment method
                </h1>
                <div class="row payment-method">
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" checked required><i class="fa fa-paypal"></i> PayPal</label>
                        </div>
                    </div>
                </div>
            </section>
            <section>

                <div class="order-summery">
                    <h2>ORDER SUMMARY</h2>
                    @foreach($items as $key=>$item)
                    <div class="cart-item">
                        <div class="row cart-item-det">
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

                    </div>
                    @endforeach
                </div>
                <span>By proceeding, you confirm that you accept our <a href="">Terms of Use</a> and the <a href="">Terms of Business</a>.</span>
                <div class="total-summary">
                    <div class="row">
                        <div class="col-md-6">
                            Total Price
                        </div>
                        <div class="col-md-6 text-right">
                            {{Vars::getVar('€').$total}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-push-6 text-right">
                            <button class="btn btn-info">
                                Proceed to payment
                            </button>
                        </div>
                    </div>

                </div>
            </section>
        </form>
    </div>
</div>
@endsection