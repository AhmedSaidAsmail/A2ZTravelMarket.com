@extends('Supplier.Layouts.Layout_Basic')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>{{ $item->name }} <small>Gallery</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Items :{{ $item->name }} </a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Gallery List</a></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <form method="post" action="{{route('ItemGallery.store',['item'=>$item->id])}}" class="dropzone" id="addImages">
                                        <input type="hidden" value="{{csrf_token()}}" name="_token">

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('suItems.edit',['item'=>$item->id]) }}" class="btn btn-bitbucket">
                                        <i class="fa fa-dashboard"></i> Return Back to {{$item->name}} Dashboard</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

@endsection