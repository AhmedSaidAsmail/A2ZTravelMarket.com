@extends('Supplier.Layouts.Layout_Basic')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/lib/css/prettify.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/src/bootstrap-wysihtml5.css')}}" />
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>Items <small>Explanation</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Tour :{{ $item->name}} </a></li>
        </ol>
    </section>

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
    @endif
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Explanation List</a></h3>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Explanation Table</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <table class="table table-striped">
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Explanation Text</th>
                                                <th>Edit</th>
                                                <th style="width: 40px">Delete</th>
                                            </tr>
                                            <?php $oredr = 1 ?>
                                            @if(isset($explanation))
                                            <tr>
                                                <td>{{$oredr}}</td>
                                                <td>{!! $explanation->txt !!}</td>
                                                <td><a href="{{ route('Exploration.edit',[$item->id,$explanation->id]) }}" class="btn btn-xs btn-warning">Edit</a></td>
                                                <td><a href="{{ route('Exploration.show',[$item->id,$explanation->id]) }}"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <?php $oredr++ ?>
                                            @endif
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('Items.edit',['item'=>$item->id]) }}" class="btn btn-bitbucket"><i class="fa fa-dashboard"></i> Return Back to Explanation List</a>
                                    <a href="{{ route('Exploration.create',['item'=>$item->id]) }}" class="btn btn-primary"><i class="fa fa-dashboard"></i> Add New Exploration</a>

                                </div>
                            </div>
                        </div>



                    </div>

                </div>
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
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script>
$(function() {
    $(".select2").select2();
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false
    });
});
</script>
@endsection
