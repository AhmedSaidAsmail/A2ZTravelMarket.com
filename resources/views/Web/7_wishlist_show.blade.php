@extends('Web.Layouts.master')
@section('meta_tags')
<title>My Wishlist</title>
@endsection

@section('content')

<h1 class="wishlist-header">My Wishlist</h1>
<span class="wishlist-span"><i class="fa fa-heart-o"></i> 
    @if (Auth::guard('customer')->check())
    {{\App\Http\Controllers\Web\WishlistController::customerWishlistCount()}} 
    @else
    @if(Session::has('wishlist') && Session::get('wishlist')->totalQty >0)
    {{Session::get('wishlist')->totalQty}}
    @endif
    @endif
    item</span>
<?php
if (Auth::guard('customer')->check()) {
    $cutomer_id = Auth::guard('customer')->user()->id;
} else {
    $cutomer_id = null;
}
?>
@if(!is_null($customerWishlist))
@foreach($customerWishlist as $wishlist)
<?php
$item = $wishlist->item;
?>
<a href="{{route('tour.show',['city'=>$item->attraction->sort->name,'tour'=>$item->name,'id'=>$item->id])}}" class="item-tour-link">
    <div class="row item-tour" id="item-tour">
        <a href="{{route('wishlist.remove')}}?item_id={{$item->id}}&customer_id={{$cutomer_id}}" class="remove-wishlist"><i class="fa fa-times"></i></a>
        <div class="col-md-3">
            <div class="item-tour-img">
                <img src="{{asset('images/items/thumb/'.$item->img)}}" class="img-abs-center" alt="{{$item->name}}">
            </div>
        </div>
        <div class="col-md-9 item-tour-right">
            <div class="tour-price-from"><span>{{Vars::getVar('From')}}</span>{{Vars::getVar('€')}}
                {{\App\Http\Controllers\Web\AttractionController::getLowestPrice($item->id)}}</div>
            <div class="tour-duration">
                <i class="fa fa-clock-o"></i> <label>{{Vars::getVar('Duration')}}:</label> {{$item->duration}} {{Vars::getVar('hours')}}
            </div>
            <h2>{{$item->name}}{{$item->id}}</h2>
            <div class="item-tour-rating">
                {{ App\Http\Controllers\ReviewController::getRateStar(App\Http\Controllers\ReviewsRateCalculate::calc($item->id,'overall_rating')) }}
                {{count($item->reviews()->where('confirm',1)->get())}} {{Vars::getVar('Reviews')}}
            </div>
            <span class="item-tour-intro">
                {!! \Illuminate\Support\Str::limit($item->intro, $limit = 147, $end = '...') !!}
            </span>
        </div>
    </div>
</a>
@endforeach
@else
@if(!is_null($sessionWishlist))
@foreach($sessionWishlist as $id)
<?php $item = \App\Models\Item::find($id) ?>
<a href="{{route('tour.show',['city'=>$item->attraction->sort->name,'tour'=>$item->name,'id'=>$item->id])}}" class="item-tour-link">
    <div class="row item-tour" id="item-tour">
        <a href="{{route('wishlist.remove')}}?item_id={{$item->id}}&customer_id={{$cutomer_id}}" class="remove-wishlist"><i class="fa fa-times"></i></a>
        <div class="col-md-3">
            <div class="item-tour-img">
                <img src="{{asset('images/items/thumb/'.$item->img)}}" class="img-abs-center" alt="{{$item->name}}">
            </div>
        </div>
        <div class="col-md-9 item-tour-right">
            <div class="tour-price-from"><span>{{Vars::getVar('From')}}</span>{{Vars::getVar('€')}}
                {{\App\Http\Controllers\Web\AttractionController::getLowestPrice($item->id)}}</div>
            <div class="tour-duration">
                <i class="fa fa-clock-o"></i> <label>{{Vars::getVar('Duration')}}:</label> {{$item->duration}} {{Vars::getVar('hours')}}
            </div>
            <h2>{{$item->name}}{{$item->id}}</h2>
            <div class="item-tour-rating">
                {{ App\Http\Controllers\ReviewController::getRateStar(App\Http\Controllers\ReviewsRateCalculate::calc($item->id,'overall_rating')) }}
                {{count($item->reviews()->where('confirm',1)->get())}} {{Vars::getVar('Reviews')}}
            </div>
            <span class="item-tour-intro">
                {!! \Illuminate\Support\Str::limit($item->intro, $limit = 147, $end = '...') !!}
            </span>
        </div>
    </div>
</a>
@endforeach
@endif
@endif




@endsection