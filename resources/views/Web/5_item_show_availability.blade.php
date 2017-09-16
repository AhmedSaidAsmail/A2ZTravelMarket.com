<?php $oder = 0 ?>
@foreach($dates as $date)
@if(\App\Http\Controllers\Web\ItemsController::checkAvailability($date,$day))
<?php
$class = ($oder == 0) ? "price-active" : "price-not-active";
?>
<div class="row price-plane-avaiable {{$class}}">
    @if($date->discount > 0)
    <div class="item-tour-discount">
        SAVE UP TO {{$date->discount}}%
    </div>
    @endif
    <div class="col-md-12 first-row">
        <div class="row">
            <div class="col-md-6">
                {!! (!is_null($date->language))?ucfirst($date->language)." Tour":null !!}
                {!! (!is_null($date->capacity))?": Up to".$date->capacity." People":null !!}
            </div>
            <div class="col-md-5 text-right price-plane-total">
                <label>Total price</label>
               {!! \App\Http\Controllers\Web\ItemsController::getTotalPrice($request,$date) !!}
            </div>
            <div class="col-md-1 text-right">
                <span class="fa-stack" id="hide-plane">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-check fa-inverse fa-stack-1x"></i>
                </span>
                <span class="fa-stack" id="active-plane">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-caret-down fa-inverse fa-stack-1x"></i>
                </span>
            </div>
        </div>
        @if(!is_null($date->capacity))
        <div class="row">
            <div class="col-md-12">
                A maximum of {{$date->capacity}} participants will be on this tour
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-12 second-row">
        <div class="row">
            <div class="col-md-6">
                Starting time
                <span style="display: block;">{{date('h:i A',strtotime($date->starting_time))}}</span>
            </div>
            <div class="col-md-6 price-all-details">
                <div class="row">
                    <div class="col-md-6">
                        Price Breakdown
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {{$item->price_definition->st_price_name}} {{$request->st_no}} x 
                        {{Vars::getVar('€')}}{{$date->st_price}}
                    </div>
                    <div class="col-md-6 text-right">
                        {{Vars::getVar('€')}}{{$request->st_no*$date->st_price}}
                    </div>
                </div>
                @if($request->sec_no!=0)
                <div class="row">
                    <div class="col-md-6">
                        {{$item->price_definition->sec_price_name}} {{$request->sec_no}} x 
                        {{Vars::getVar('€')}}{{$date->sec_price}}
                    </div>
                    <div class="col-md-6 text-right">
                        {{Vars::getVar('€')}}{{$request->sec_no*$date->sec_price}}
                    </div>
                </div>
                @endif
                @if($request->third_no!=0)
                <div class="row">
                    <div class="col-md-6">
                        {{$item->price_definition->third_price_name}} {{$request->third_no}} x 
                        {{Vars::getVar('€')}}{{$date->third_price}}
                    </div>
                    <div class="col-md-6 text-right">
                        {{Vars::getVar('€')}}{{$request->third_no*$date->third_price}}
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="row price-add-cart">
            <div class="col-md-12 text-right">
                <form method="post" action="{{route('reservation.cart.add')}}">
                    {{csrf_field()}} 
                    <input type="hidden" name="item_id" value="{{$date->item->id}}" />
                    <input type="hidden" name="price_id" value="{{$date->id}}" />
                    <input type="hidden" name="price" value="{{ \App\Http\Controllers\Web\ItemsController::getTotalPriceAmount($request,$date)}}">
                    <input type="hidden" name="date" value="{{$tourDate}}">
                    <input type="hidden" name="st_no" value="{{$request->st_no}}">
                    <input type="hidden" name="sec_no" value="{{$request->sec_no}}">
                    <input type="hidden" name="third_no" value="{{$request->third_no}}">
                    <input type="hidden" name="discount" value="{{$date->discount}}">
                  <button class="btn btn-info">Add to Cart</button>  
                </form>
                
            </div>
        </div>
    </div>

</div>
<?php $oder++; ?>
@else
<div class="row price-plane-avaiable price-not-active">
    <div class="col-md-12 first-row">
        <div class="row" id="not-available">
            <div class="col-md-6">
                {!! (!is_null($date->language))?ucfirst($date->language)." Tour":null !!}
                {!! (!is_null($date->capacity))?": Up to".$date->capacity." People":null !!}
                <span class="not-available-warning">Not available</span>
                <div class="next-date">
                    Next available date: <a href="#" id="another-date" data-date="{{date('M d,Y',strtotime('next '.$date->week_day))}}">
                        {{date('l, F d Y',strtotime('next '.$date->week_day))}}
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>
@endif
@endforeach


