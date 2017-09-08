@extends('Admin.Layouts.Layout_Basic')
@section('title','Category Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>Attraction <small>Attraction Update</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Attraction : {{$attraction->name}}</a></li>
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
                            <button type="submit" class="form-control btn-danger" >Update Attraction : ({{$attraction->name}})</button>
                        </div>
                    </div>

                    <form method="post" action="{{route('Category.update',['id'=>$attraction->id])}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{($errors->has('basicsort_id'))?'has-error':''}}">
                                        <label>Main Category Name:</label>
                                        <select class="form-control" name="basicsort_id">
                                            <option value="">Select a City</option>
                                            @foreach (App\Models\Sort::all() as $city)
                                            <option value="{{$city->id}}" {!!$city->id==$attraction->sort_id?'selected="selected"':'null'!!}>{{$city->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Attraction Name:</label>
                                        <input class="form-control" value="{{$attraction->name}}" name="name"  required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Attraction Title:</label>
                                        <input class="form-control" value="{{$attraction->title}}" name="title"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" >Show</option>
                                            <option value="0" {!! (! $attraction->status)?'selected="selected"':'' !!}>Hidden</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Home Shortcut</label>

                                        <select class="form-control" name="recommended">
                                            <option value="1">Show</option>
                                            <option value="0" {!! (! $attraction->recommended)?'selected="selected"':'' !!}>Hidden</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group {{$errors->has('arrangement')?'has-error':''}}">
                                        <label>Arrangment</label>
                                        <input  value="{{$attraction->arrangement}}" name="arrangement" class="form-control">
                                        @if($errors->has('arrangement'))
                                        <span class="help-block">The Arrangment has to be Integer</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('img')?'has-error':''}}">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="img">
                                        @if($errors->has('img'))
                                        <span class="help-block">It has to be an Image File</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keywords:</label>
                                        <input class="form-control" value="{{$attraction->keywords}}" name="keywords" placeholder="-- Keywords --" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description:</label>
                                        <input class="form-control" value="{{$attraction->description}}" name="description" placeholder="-- Description --" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Text</label>
                                        <textarea class="form-control" name="txt">{{$attraction->txt}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"> 
                                <button class="btn btn-danger"><i class="fa fa-pencil-square"></i> Update {{$attraction->name}}</button>
                            </div>
                            <div class="form-group"> </div>
                        </div>
                    </form>

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
@endsection