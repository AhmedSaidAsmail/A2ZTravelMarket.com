@extends('Web.Layouts.master')
@section('meta_tags')
<title>My Bookings</title>
@endsection

@section('content')

<h1 class="wishlist-header">My Bookings</h1>
<div class="row">
    <div class="col-md-9">
        @foreach($reservations as $reservation)
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
                        <a href="{{route('customer.bookings.items',['reservation_id'=>$reservation->id])}}" class="btn btn-sm btn-default">Show <i class="fa fa-angle-right"></i></a>

                </div>
                <div class="col-md-2">
                    <label>Total</label>
                </div>
                <div class="col-md-4">
                    {{Vars::getVar('€')}}{{$reservation->total}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection