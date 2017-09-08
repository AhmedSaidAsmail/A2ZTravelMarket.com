@extends('Admin.Layouts.Layout_Basic')
@section('title','Main Category Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1> Countries <small>Countries Update</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Country : {{$basicSort->name}}</a></li>
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
                            <button type="submit" class="form-control btn-danger" >Update Country : ({{$basicSort->name}})</button>
                        </div>
                    </div>

                    <form method="post" action="{{route('MainCategory.update',['id'=>$basicSort->id])}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country Name:</label>
                                        <input class="form-control" value="{{$basicSort->name}}" name="name"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country Page Title:</label>
                                        <input class="form-control" value="{{$basicSort->title}}" name="title" placeholder="Main category Title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Status</label>

                                        <select class="form-control" name="status">
                                            <option value="0" >Hidden</option>
                                            <option value="1" {!! $basicSort->status?'selected="selected"':null !!}>Show</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Top 10 List</label>
                                        <select class="form-control" name="top_list">
                                            <option value="0" >False</option>
                                            <option value="1" {!! $basicSort->top_list?'selected="selected"':null !!}>True</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group {{$errors->has('arrangement')?'has-error':''}}">
                                        <label>Arrangment</label>
                                        <input  value="{{$basicSort->arrangement}}" name="arrangement" class="form-control">
                                        @if($errors->has('arrangement'))
                                        <span class="help-block">The Arrangment has to be Integer</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                        <input class="form-control" value="{{$basicSort->keywords}}" name="keywords" placeholder="-- Keywords --" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description:</label>
                                        <input class="form-control" value="{{$basicSort->description}}" name="description" placeholder="-- Description --" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><i class="fa fa-language"></i> Language</label>
                                        <input value="{{$basicSort->language}}" name="language" class="form-control" placeholder="EG: Modern Standard Arabic" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><i class="fa fa-money"></i> Currency</label>
                                        <input value="{{$basicSort->currency}}" name="currency" class="form-control" placeholder="EG: Egyptian Pound EGP (£)" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><i class="fa fa-globe"></i> Time Zone</label>
                                        <input value="{{$basicSort->time}}" name="time" class="form-control" placeholder="EG: UTC (+02:00)" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><i class="fa fa-phone"></i> Country Code</label>
                                        <input value="{{$basicSort->code}}" name="code" class="form-control" placeholder="EG: +20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><i class="fa fa-calendar"></i> Best time to visit</label>
                                        <textarea class="form-control" name="best_time" required>{{$basicSort->best_time}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"> 
                                <button class="btn btn-danger"><i class="fa fa-pencil-square-o"></i> Update {{$basicSort->name}}</button>
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