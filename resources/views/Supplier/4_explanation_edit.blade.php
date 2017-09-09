@extends('Supplier.Layouts.Layout_Basic')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>{{$item->name}} <small>Explanation</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update {{$item->name}} </a></li>
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
                        <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Add Explanation</a></h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('Exploration.update',['itemID'=>$item->id,'id'=>$prev->id]) }}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Text</label>
                                    <textarea  name="txt" class="textarea form-control">{{ $prev->txt }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('suItems.edit',['item'=>$item->id]) }}" class="btn btn-bitbucket">
                                        <i class="fa fa-dashboard"></i> Return Back to Item Dashboard</a>
                                    <button class="btn btn-primary"><i class="fa fa-paw"></i> Update Exploration</button>
                                </div>
                            </div>

                        </form>
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
<script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
$(function () {
    $(".textarea").wysihtml5();
});
</script>
@endsection
