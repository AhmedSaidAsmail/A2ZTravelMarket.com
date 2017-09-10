@extends('Admin.Layouts.Layout_Basic')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<style>
    td.pricetable{
        padding-top: 0px;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> {{session('error')}} </h4>
    </div>
    @endif
    @if(Session::has('errorMsg'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> {{Session('errorMsg')}} </h4>
        ..<a href="#" id="errorDetails">Details</a>
        {!! (Session::has('errorDetails'))?'<p id="ErrorMsgDetails">'.Session('errorDetails').'</p>':'' !!}
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
    @endif
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>Activities <small>Tour Update</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Tour : {{$Item->name}}</a></li>
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
                            <button type="submit" class="btn btn-danger btn-block" id="addNew">
                                <i class="fa fa-paw"></i> Update: {{$Item->name}}</button>
                        </div>
                    </div>
                    <div id="basicToggle">
                        <form method="post" action="{{route('Items.update',['id'=>$Item->id])}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="0">False</option>
                                                <option value="1" {!! ($Item->status)?'selected="selected"':'' !!}>True</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Recommended</label>
                                            <select name="recommended" class="form-control">
                                                <option value="0">False</option>
                                                <option value="1" {!! ($Item->recommended)?'selected="selected"':'' !!}>True</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger"><i class="fa fa-bicycle"></i> Update {{$Item->name}}</button>
                                </div>
                                <div class="form-group"> </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Item Price -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-th"></i> Tour Prices Definitions</a> </h3>
                    </div>
                    <div class="box-body">
                        @if(! is_null($price_def))
                        <div class="row">
                            <div class="col-md-2">
                                <span class="h4">First Def:</span>
                            </div>
                            <div class="col-md-1">
                                {{$price_def->st_price_name}}
                            </div>
                            <div class="col-md-2">
                                <span class="h4">First Def:</span>
                            </div>
                            <div class="col-md-1">
                                {{$price_def->sec_price_name}}
                            </div>
                            <div class="col-md-2">
                                <span class="h4">First Def:</span>
                            </div>
                            <div class="col-md-1">
                                {{$price_def->third_price_name}}
                            </div>
                        </div>

                        @endif


                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-th"></i> Tour Prices</a> Table</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table-striped" style="min-width: 100%;">
                                <thead>
                                    <tr>
                                        <th>First Price</th>
                                        <th>Second Price</th>
                                        <th>Third Price</th>
                                        <th>Private</th>
                                        <th>Language</th>
                                        <th>Capacity</th>
                                        <th>Days</th>
                                        <th>Starting@</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty ($Item->price))
                                    @foreach($Item->price()->where('deleted',0)->get() as $price)
                                    <tr>
                                        <td class="pricetable">
                                            {{$price->st_price}}
                                        </td>
                                        <td class="pricetable">
                                            {{$price->sec_price}}
                                        </td>
                                        <td class="pricetable">
                                            {{$price->third_price}}
                                        </td>
                                        <td class="pricetable">  
                                            {!! $price->private?'<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i> '!!}
                                        </td>
                                        <td class="pricetable">   
                                            {{$price->language}}
                                        </td>
                                        <td class="pricetable">
                                            {{$price->capacity}}
                                        </td>
                                        <td class="pricetable">
                                            {{$price->week_day}}
                                        </td>
                                        <td class="pricetable">
                                            {{$price->starting_time}}
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Item Price End -->
                <!-- Item Exploration  -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-clock-o"></i> Exploration </a></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if(isset($Item->exploration))
                                {!!$Item->exploration->txt !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item Exploration End -->


                <div class="row">
                    <div class="col-md-6">
                        <!-- Inclusions -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Inclusions Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Inclusions Text</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->inclusion as $inclusion)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$inclusion->txt}}</td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Inclusions-->
                        <!-- Additional Information -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Know before you go</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Information Text</th>

                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->additional as $additional)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$additional->txt}}</td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Additional Information-->
                    </div>
                    <div class="col-md-6">
                        <!-- Exclusion -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Exclusions Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Exclusions Text</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->exclusion as $exclusion)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$exclusion->txt}}</td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Inclusions-->

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
$(function () {
    $(".select2").select2();
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false
    });
});
</script>
<script>
    $(document).ready(function () {
        $("#add_new_price").click(function () {
            $("#price_form").show();
        });
        $("button#do_change").click(function () {
            var it_form = $(this).closest("td").find("form#change_status");
            it_form.submit();
        });
        $("a#delet_price").click(function (event) {
            event.preventDefault();
            var it_form = $(this).closest("tr").find("form#price_destory");
            it_form.submit();

        });
    });

</script>

@endsection