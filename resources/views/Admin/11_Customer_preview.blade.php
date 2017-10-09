@extends('Admin.Layouts.Layout_Basic')
@section('title','Main Category Panel')
@section ('Extra_Css')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1> Customers <small>{{$customer->email}}</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel </a></li>
            <li><a href="#">{{$customer->name}}</a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Customer Information</h3> 
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-1">
                                <label>Email:</label>
                            </div>
                            <div class="col-md-4">
                                {{$customer->email}}
                            </div>
                            <div class="col-md-1">
                                <label>Name:</label>
                            </div>
                            <div class="col-md-4">
                                {{$customer->name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <label>Address:</label>
                            </div>
                            <div class="col-md-4">
                                {{$customer->address}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <label>Country/City:</label>
                            </div>
                            <div class="col-md-4">
                                {{$customer->country}}/{{$customer->city}}
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <label>phone:</label>
                            </div>
                            <div class="col-md-4">
                                {{$customer->phone}}
                            </div>

                        </div>
                    </div>
                </div>


                    <!-- /.box-header -->
                     <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Reservations Data With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Tours</th>
                                   
                                    <th>Total</th>
                                    <th>Deposit</th>
                                    <th>Paid</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($customer->reservations as $reservation)
                                <tr>
                                    <td>{{$reservation->name}}</td>
                                    <td>{{$reservation->email}}</td>
                                    <td>{{$reservation->created_at}}</td>
                                    <td>{{$reservation->tours}}</td>
                                    
                                    <td>{{$reservation->total}}</td>
                                    <td>{{$reservation->deposit}}</td>
                                    <td> {!! ($reservation->paid)? '<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i>' !!} </td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</                                                            span> </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('Reservation.show',['id'=>$reservation->id])}}">Show</a></li>
                                            </ul>
                                        </div></td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Tours</th>
                                   
                                    <th>Total</th>
                                    <th>Deposit</th>
                                    <th>Paid</th>
                                    <th>#Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                    <!-- /.box-body -->
                
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- end content -->
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
$(function () {
    $("#example1").DataTable();
});
</script>

@endsection
