
<?php //echo "<pre>" . print_r(Session::all(), true)                       ?>
@extends('Supplier.Layouts.Layout_Basic')
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
                <!-- box -->
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-danger" id="addNew"><i class="fa fa-bicycle fa-lg"></i> Add New Activity</button>
                        </div>
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> {{session('success')}} </h4>
                        </div>
                        @endif
                        @if(session('failure'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> {{session('failure')}} </h4>
                        </div>
                        @endif
                        @if(count($errors)>0)
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
                        @elseif(Session::has('fetchData'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            {{Session('fetchData')}}
                        </div>
                        @endif
                    </div>
                    <div id="basicToggle">
                        <form method="post" action="{{ route('suItems.store')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" value="{{Auth::user()->id}}" name="supplier_id">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Attraction Name:</label>
                                            <select class="form-control" name="attraction_id">
                                                <option value="">Select an Attraction</option>
                                                @foreach (\App\Models\Attraction::all() as $category)
                                                <option value="{{$category->id}}">{{$category->name}} ( {{$category->sort->name}}/{{$category->sort->basicsort->name}} )</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tour Name:</label>
                                            <input class="form-control" name="name" placeholder="Eg: Cairo by bus from sharm el sheikh" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tour page title:</label>
                                            <input class="form-control" name="title" placeholder="Eg: Amazing Trip To Cairo" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="img">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Keywords:</label>
                                            <input class="form-control" name="keywords" placeholder="-- Keywords --" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <input class="form-control" name="description" placeholder="-- Description --" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Intro</label>
                                            <textarea class="form-control" name="intro"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <button class="btn btn-danger"><i class="fa fa-bicycle"></i> Add the new Tour</button>
                                </div>
                                <div class="form-group"> </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end box 1 -->
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Categories Data With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>City</th>
                                    <th>Attraction</th>
                                    <th>Tour</th>
                                    <th>Visitors</th>
                                    <th>Status</th>
                                    <th>Recommended</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach(Auth::user()->items as $Item)
                                <tr>
                                    <td>{{$Item->attraction->sort->name}}</td>
                                    <td>{{$Item->attraction->name}}</td>
                                    <td>{{$Item->name}}</td>
                                    <td>{{$Item->visits}}</td>
                                    <td> @if($Item->status) <i class="fa fa-circle text-green"></i> @else <i class="fa fa-circle text-gray"></i> @endif </td>
                                    <td> @if($Item->recommended) <i class="fa fa-circle text-green"></i> @else <i class="fa fa-circle text-gray"></i> @endif </td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('suItems.edit',['id'=>$Item->id])}}">Change</a></li>

                                                <form action="{{route('suItems.destroy',['id'=>$Item->id])}}" method="post">
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
                                    <th>Visitors</th>
                                    <th>Status</th>
                                    <th>Recommended</th>
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