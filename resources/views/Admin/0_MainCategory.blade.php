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
        <h1> Main Countries <small>Countries tables</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel </a></li>
            <li><a href="#">Main Countries</a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- box -->
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-default" id="addNew"><i class="fa fa-code"></i> Add New Country</button>
                        </div>
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> {{session('success')}} </h4>
                        </div>
                        @endif
                        @if(Session::has('errorMsg'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> {{Session('errorMsg')}} </h4>
                            ..<a href="#" id="errorDetails">Details</a>
                            {!! (Session::has('errorDetails'))?'<p id="ErrorMsgDetails">'.Session('errorDetails').'</p>':'' !!}
                        </div>
                        @elseif(count($errors)>0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @elseif(Session::has('deleteStatus'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            {{Session('deleteStatus')}}
                        </div>
                        @endif
                    </div>
                    <div id="basicToggle">
                        <form method="post" action="{{route('MainCategory.store')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country Name:</label>
                                            <input class="form-control" name="name" placeholder="Country Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country Page Title:</label>
                                            <input class="form-control" name="title" placeholder="Page Title" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Show</option>
                                                <option value="0">Hidden</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Top 10 List</label>
                                            <select class="form-control" name="top_list">
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>List Arrangement</label>
                                            <input  value="0" name="arrangement"  class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="img" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country Keywords</label>
                                            <input class="form-control" name="keywords" placeholder="-- Keywords --" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country Description</label>
                                            <input class="form-control" name="description" placeholder="-- Description --" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><i class="fa fa-language"></i> Language</label>
                                            <input name="language" class="form-control" placeholder="EG: Modern Standard Arabic" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><i class="fa fa-money"></i> Currency</label>
                                            <input name="currency" class="form-control" placeholder="EG: Egyptian Pound EGP (£)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><i class="fa fa-globe"></i> Time Zone</label>
                                            <input name="time" class="form-control" placeholder="EG: UTC (+02:00)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><i class="fa fa-phone"></i> Country Code</label>
                                            <input name="code" class="form-control" placeholder="EG: +20" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><i class="fa fa-calendar"></i> Best time to visit</label>
                                            <textarea class="form-control" name="best_time" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> <button class="btn btn-success"><i class="fa fa-map-marker"></i> Add new country</button></div>
                                <div class="form-group"> </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end box 1 -->
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Main Categories Data With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Top List</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($Bsorts as $Bsort)
                                <tr>
                                    <td>{{$Bsort->name}}</td>
                                    <td>{{$Bsort->title}}</td>
                                    <td> {!! ($Bsort->status)? '<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i>' !!} </td>
                                    <td> {!! ($Bsort->top_list)? '<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i>' !!} </td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                                            <div class="dropdown-menu list-group" >
                                                <a href="{{route('MainCategory.edit',['id'=>$Bsort->id])}}" class="list-group-item">Change</a>
                                                <form action="{{route('MainCategory.destroy',['id'=>$Bsort->id])}}" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="#" class="deleteItem list-group-item" title="{{$Bsort->name}}">Delete</a>
                                                </form>
                                            </div>
                                        </div></td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Country</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Top List</th>
                                    <th>#Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
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