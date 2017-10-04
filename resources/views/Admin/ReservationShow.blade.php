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
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-12">
                                <a href="" class="btn btn-info btn-block"><i class="fa fa-mail-forward"></i>Send Email</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($reservation->ResTours)>0)
                @foreach($reservation->ResTours as $tour)
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{$tour->title}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Price:</div>
                            <div class="col-md-2">{{$tour->price}}</div>
                            <div class="col-md-2">Date:</div>
                            <div class="col-md-2">{{$tour->date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">{{$tour->st_name}}</div>
                            <div class="col-md-2">{{$tour->st_no}}</div>
                            <div class="col-md-2">Price</div>
                            <div class="col-md-2">{{$tour->st_price}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">{{$tour->sec_name}}</div>
                            <div class="col-md-2">{{$tour->sec_no}}</div>
                            <div class="col-md-2">Price</div>
                            <div class="col-md-2">{{$tour->sec_price}}</div>
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

