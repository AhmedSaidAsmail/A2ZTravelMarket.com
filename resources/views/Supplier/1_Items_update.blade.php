@extends('Supplier.Layouts.Layout_Basic')
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
                        <form method="post" action="{{route('suItems.update',['id'=>$Item->id])}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" value="{{Auth::user()->id}}" name="supplier_id">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Attraction Name:</label>
                                            <select class="form-control" name="attraction_id">
                                                <option value="">Select an Attraction</option>
                                                @foreach (\App\Models\Attraction::all() as $category)
                                                <option value="{{$category->id}}" {!!($category->id==$Item->attraction_id)?'selected="selected"':''!!}>{{$category->name}} ( {{$category->sort->name}}/{{$category->sort->basicsort->name}} )</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tour Name:</label>
                                            <input class="form-control" value="{{$Item->name}}" name="name"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tour page title:</label>
                                            <input class="form-control" value="{{$Item->title}}" name="title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('img')?'has-error':''}}">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="img">
                                            @if($errors->has('img'))
                                            <span class="help-block">It has to be an Image File</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Duration:</label>
                                            <input type="number" class="form-control" name="duration" value="{{$Item->duration}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Keywords:</label>
                                            <input class="form-control" value="{{$Item->keywords}}" name="keywords" placeholder="-- Keywords --" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <input class="form-control" value="{{$Item->description}}" name="description" placeholder="-- Description --" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Intro</label>
                                            <textarea class="form-control" name="intro">{{$Item->intro}}</textarea>
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
                            <div class="col-md-3">
                                <button class="btn btn-warning btn-block"><i class="fa fa-pencil-square"></i> Edit</button>
                            </div>
                        </div>
                        @else
                        <div>
                            <form method="post" action="{{route('Price_Definitions.store')}}">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                <input type="hidden" value="{{$Item->id}}" name="item_id">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>First Definition:</label>
                                            <input type="text" name="st_price_name" class="form-control" placeholder="Eg : Adult" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Second Definition:</label>
                                            <input type="text" name="sec_price_name" class="form-control" placeholder="Eg : Child" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Third Definition:</label>
                                            <input type="text" name="third_price_name" class="form-control" placeholder="Eg : Inf">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label></label>
                                            <button class="btn btn-primary form-control"><i class="fa fa-paw"></i> Add Price Definition</button>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                        </div>
                        @endif


                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-th"></i> Tour Prices</a> Table</h3>
                    </div>
                    <div class="box-body">
                        <div class="row" style="margin-bottom:40px;">
                            <div class="col-md-12">
                                <button class="btn btn-block btn-success" id="add_new_price">
                                    <i class="fa fa-money"></i> Add new Price
                                </button>
                            </div>
                        </div>
                        <form action="{{route('Price.store')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$Item->id}}" name="item_id">
                            <div style="display:none;" id="price_form">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>First Price</label>
                                            <input type="number" class="form-control" name="st_price"  min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Second Price</label>
                                            <input type="number" class="form-control" name="sec_price"  min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Third Price</label>
                                            <input type="number" class="form-control" value="" name="third_price" min="0" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Private</label>
                                            <select name="private" class="form-control">
                                                <option value="0">Not Private</option>
                                                <option value="1">Private</option>
                                            </select>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Language</label>
                                            <select class="form-control" name="language">
                                                <option value="">Select Language</option>
                                                <option value="english">English</option>
                                                <option value="spanish">Spanish</option>
                                                <option value="italian">Italian</option>
                                                <option value="russian">Russian</option>
                                                <option value="german">German</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Capacity</label>
                                            <input type="number" class="form-control" name="capacity" min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Days</label>
                                            <select class="form-control" name="week_day">
                                                <option value="all">Every Day</option>
                                                <option value="Saturday">Saturday</option>
                                                <option value="Sunday">Sunday</option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Friday">Friday</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label>Starting time:</label>
                                                <div class="input-group">
                                                    <input type="text" name="starting_time" class="form-control timepicker" required>
                                                    <div class="input-group-addon"> <i class="fa fa-clock-o"></i> </div>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>*</label>
                                            <button class="btn btn-success btn-block"><i class="fa fa-pencil"></i> Add Price</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

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
                                        <td class="text-right pricetable" style="min-width: 150px; padding-bottom: 5px; padding-top: 5px;">
                                            <?php
                                            if ($price->status) {
                                                $value = 0;
                                                $word = "disable";
                                                $class = "btn-warning";
                                            } else {
                                                $value = 1;
                                                $word = "enable";
                                                $class = "btn-success";
                                            }
                                            ?>
                                            <button class="btn {{$class}} btn-sm" id="do_change">{{$word}}</button>
                                            <a class="btn btn-danger btn-sm" id="delet_price"><i class="fa fa-trash"></i></a>
                                            <form method="post" action="{{route('Price.update',['id'=>$price->id])}}" id="change_status">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="status" value="{{$value}}">
                                            </form>
                                            <form action="{{route('Price.destroy',['id'=>$price->id])}}" method="post" id="price_destory">
                                                {{csrf_field()}}
                                                <input type="hidden" value="DELETE" name="_method">
                                            </form>

                                        </td>
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
                                <div class="form-group">
                                    <select class="form-control" name="galleryAction" id="galleryNav">
                                        <option value="">Select an Action</option>
                                        <option value="{{route('Exploration.create',['itemID'=>$Item->id])}}">Add New</option>
                                        <option value="{{ route('Exploration.index',['itenID'=>$Item->id]) }}">Exploration List</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item Exploration End -->


                <div>
                    <form action="{{route('Information.create',['itemID'=>$Item->id])}}" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Add New Details To This Items</label>
                                    <select name="modelName" class="form-control" id="detailsNavigatore">
                                        <option value="">Select Details to Add</option>
                                        <option value="inclusion">Inclusions</option>
                                        <option value="exclusion">Exclusions</option>
                                        <option value="additional">Know before you go</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

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
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->inclusion as $inclusion)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$inclusion->txt}}</td>
                                        <td>
                                            <a href="{{route('Information.edit',['item'=>$Item->id,'Information'=>$inclusion->id,'modelName'=>'inclusion'])}}" class="btn btn-xs btn-warning">
                                                Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('Information.destroy',[$Item->id,$inclusion->id]) }}" method="post">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="modelName" value="inclusion">
                                                <a class="deleteItem" href="#" title="{{$inclusion->id}}"><i class="fa fa-trash"></i></a>
                                            </form>
                                        </td>
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
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->additional as $additional)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$additional->txt}}</td>
                                        <td>
                                            <a href="{{route('Information.edit',['item'=>$Item->id,'rowID'=>$additional->id,'modelName'=>'additional'])}}" class="btn btn-xs btn-warning">
                                                Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('Information.destroy',[$Item->id,$additional->id]) }}" method="post">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="modelName" value="additional">
                                                <a class="deleteItem" href="#" title="{{$additional->id}}"><i class="fa fa-trash"></i></a>
                                            </form>
                                        </td>
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
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->exclusion as $exclusion)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$exclusion->txt}}</td>
                                        <td>
                                            <a href="{{route('Information.edit',['item'=>$Item->id,'Information'=>$exclusion->id,'modelName'=>'exclusion'])}}" class="btn btn-xs btn-warning">
                                                Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('Information.destroy',[$Item->id,$exclusion->id]) }}" method="post">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="modelName" value="exclusion">
                                                <a class="deleteItem" href="#" title="{{$exclusion->id}}"><i class="fa fa-trash"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Inclusions-->
                        <!-- Item Gallery -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Gallery </a></h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-control" name="galleryAction" id="galleryNav">
                                                <option value="">Select an Action</option>
                                                <option value="{{route('ItemGallery.create',['itemID'=>$Item->id])}}">Upload New Images</option>
                                                <option value="{{ route('ItemGallery.index',['itenID'=>$Item->id]) }}">Gallery List</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item Gallery End -->

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