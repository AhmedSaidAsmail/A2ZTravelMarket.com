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
        <h1> Cities <small>Cities tables</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Cities</a></li>
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
                            <button type="submit" class="form-control btn btn-danger" id="addNew">
                                <i class="fa fa-database"></i> Add New City</button>
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
                        <form method="post" action="{{route('Category.store')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Country Name:</label>
                                            <select class="form-control" name="basicsort_id" required>
                                                <option value="">Select Main Category</option>
                                                @foreach (App\Models\Basicsort::all() as $MainCategory)
                                                <option value="{{$MainCategory->id}}">{{$MainCategory->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City Name:</label>
                                            <input class="form-control" name="name" placeholder="Eg: Cairo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City Page Title:</label>
                                            <input class="form-control" name="title" placeholder="Eg: Cairo Amazing City" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Show</option>
                                                <option value="0">Hidden</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Recommended</label>
                                            <select class="form-control" name="recommended">
                                                <option value="1">Confirm</option>
                                                <option value="0">Pause</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Arrangement</label>
                                            <input  value="0" name="arrangement"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="img">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keywords:</label>
                                            <input class="form-control" name="keywords" placeholder="-- Keywords --" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <input class="form-control" name="description" placeholder="-- Description --" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Text</label>
                                            <textarea class="form-control" name="txt"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <button class="btn btn-danger"><i class="fa fa-location-arrow"></i> Add new city</button>
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
                                    <th>Main Category</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Recommended</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($Categories as $Category)
                                <tr>
                                    <td>{{$Category->basicsort->name}}</td>
                                    <td>{{$Category->name}}</td>
                                    <td>{{$Category->title}}</td>
                                    <td> @if($Category->status) <i class="fa fa-circle text-green"></i> @else <i class="fa fa-circle text-gray"></i> @endif </td>
                                    <td> @if($Category->recommended) <i class="fa fa-circle text-green"></i> @else <i class="fa fa-circle text-gray"></i> @endif </td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                                            <div class="dropdown-menu list-group" >
                                                <a class="list-group-item" href="{{route('Category.edit',['id'=>$Category->id])}}">Change</a>
                                                <form action="{{route('Category.destroy',['id'=>$Category->id])}}" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="#" class="deleteItem list-group-item" title="{{$Category->name}}">Delete</a>
                                                </form>
                                            </div>

                                        </div></td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Main Category</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Recommended</th>
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