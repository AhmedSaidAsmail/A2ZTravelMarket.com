
<?php //echo "<pre>" . print_r(Session::all(), true)                  ?>
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
        <h1> Items <small>Items tables</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Items</a></li>
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
                        <h3 class="box-title">Activities Data With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>City</th>
                                    <th>Attraction</th>
                                    <th>Tour</th>
                                    <th>Supplier</th>
                                    <th>Vis</th>
                                    <th>Rev</th>
                                    <th>Rat</th>
                                    <th>St</th>
                                    <th>Res</th>
                                    <th>Rec</th>
                                    <th style="min-width: 70px;">#Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($Items as $Item)
                                <tr>
                                    <td>{{$Item->attraction->sort->name}}</td>
                                    <td>{{$Item->attraction->name}}</td>
                                    <td>{{$Item->name}}</td>
                                    <td>{{$Item->supplier->email}}</td>
                                    <td>{{$Item->visits}}</td>
                                    <td>{{$Item->reviews()->count()}}</td>
                                    <td>{{\App\Http\Controllers\ReviewsRateCalculate::calc($Item->id,'overall_rating',"all")}}</td>
                                    <td> @if($Item->status) <i class="fa fa-circle text-green"></i> @else <i class="fa fa-circle text-gray"></i> @endif </td>
                                    <td>{{$Item->tours()->count()}}</td>
                                    <td> @if($Item->recommended) <i class="fa fa-circle text-green"></i> @else <i class="fa fa-circle text-gray"></i> @endif </td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('Items.edit',['id'=>$Item->id])}}">Change</a></li>

                                                <form action="{{route('Items.destroy',['id'=>$Item->id])}}" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <li><a class="deleteItem list-group-item" href="#" title="{{$Item->name}}">Delete</a></li>
                                                </form>
                                            </ul>
                                        </div></td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>City</th>
                                    <th>Attraction</th>
                                    <th>Tour</th>
                                    <th>Supplier</th>
                                    <th>Vis</th>
                                    <th>Rev</th>
                                     <th>Rat</th>
                                    <th>St</th>
                                    <th>Res</th>
                                    <th>Rec</th>
                                    <th>#Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
$(function() {
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