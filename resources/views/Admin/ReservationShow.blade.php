@extends('Admin.Layouts.Layout_Basic')
@section('title','Items Panel')
@section ('Extra_Css')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1> Reservations <small>Reservations Details</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Reservations</a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- box -->

                <!-- end box 1 -->
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        Reservation Details
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">Name:</div>
                            <div class="col-md-4">{{$reservation->name}} </div>
                            <div class="col-md-2">Email:</div>
                            <div class="col-md-4">{{$reservation->email}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Mobile:</div>
                            <div class="col-md-4">{{$reservation->phone}}</div>
                            <div class="col-md-2">Tours:</div>
                            <div class="col-md-4">{{$reservation->tours}}</div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">Total:</div>
                            <div class="col-md-4">{{$reservation->total}}</div>
                            <div class="col-md-2">Deposit:</div>
                            <div class="col-md-4">{{$reservation->deposit}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Paid Status:</div>
                            <div class="col-md-4">
                                @if($reservation->paid)
                                Done
                                @else
                                Not Yet
                                @endif
                            </div>
                            <div class="col-md-2">Created at</div>
                            <div class="col-md-4">{{$reservation->created_at}}</div>
                        </div>
                        <div class="row" style="border-top: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; margin:20px 0px; padding: 15px 0px;">
                            <div class="col-md-2">Payment Id</div>
                            <div class="col-md-4">{{$reservation->paymentId}}</div>
                            <div class="col-md-2">
                                <button class="btn btn-default"><i class="fa fa-bolt"></i> Confirm</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-12">
                                <a href="" class="btn btn-info btn-block"><i class="fa fa-mail-forward"></i>Send Email</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($reservation->ResTours)>0)
                @foreach($reservation->ResTours as $tour)
                <?php $itPrice = \App\Models\Price::find($tour->price_id); ?>
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{$tour->title}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><label>Price:</label></div>
                            <div class="col-md-4">{{$tour->price}}</div>
                            <div class="col-md-2"><label>Date:</label></div>
                            <div class="col-md-4">{{$tour->date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><label>Tour Name:</label></div>
                            <div class="col-md-4">{{$tour->item->name}}</div>
                            <div class="col-md-2"><label>Supplier:</label></div>
                            <div class="col-md-4">{{$tour->item->supplier->company}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><label>Title:</label></div>
                            <div class="col-md-4">
                                {!! (!is_null($itPrice->language))?ucfirst($itPrice->language)." Tour":null !!}
                                {!! (!is_null($itPrice->capacity))?": Up to".$itPrice->capacity." People":null !!}
                                {!! (($itPrice->private))?" - Private":null !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">{{$tour->item->price_definition->st_price_name}}</div>
                            <div class="col-md-4">{{$tour->st_no}}</div>
                            <div class="col-md-2">Price</div>
                            <div class="col-md-2">
                                {{$itPrice->st_price* $tour->st_no}}
                                ( {{$itPrice->st_price }} x {{$tour->st_no}} )</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">{{$tour->item->price_definition->sec_price_name}}</div>
                            <div class="col-md-4">{{$tour->sec_no}}</div>
                            <div class="col-md-2">Price</div>
                            <div class="col-md-2">
                                {{$itPrice->sec_price* $tour->sec_no}}
                                ( {{$itPrice->sec_price }} x {{$tour->sec_no}} )</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">{{$tour->item->price_definition->third_price_name}}</div>
                            <div class="col-md-4">{{$tour->third_no}}</div>
                            <div class="col-md-2">Price</div>
                            <div class="col-md-2">
                                {{$itPrice->third_price* $tour->third_no}}
                                ( {{$itPrice->third_price }} x {{$tour->third_no}} )</div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
$(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});
</script>
@endsection

