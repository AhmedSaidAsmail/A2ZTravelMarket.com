@extends('Supplier.Layouts.Layout_Basic')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
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
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('img')?'has-error':''}}">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="img">
                                            @if($errors->has('img'))
                                            <span class="help-block">It has to be an Image File</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Keywords:</label>
                                            <input class="form-control" value="{{$Item->keywords}}" name="keywords" placeholder="-- Keywords --" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                        <option value="additional">Additional Information </option>
                                        <option value="dresse">Dresses</option>
                                        <option value="note">Notes</option>
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
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'Information'=>$inclusion->id,'modelName'=>'inclusion'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'Information'=>$inclusion->id,'modelName'=>'inclusion'])}}"><i class="fa fa-trash"></i></a></td>
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
                                <h3 class="box-title">Additional Information Table</h3>
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
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'rowID'=>$additional->id,'modelName'=>'additional'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'rowID'=>$additional->id,'modelName'=>'additional'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Additional Information-->
                        <!-- Dresses -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Dresses Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Dresses Text</th>
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->dresse as $dresse)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$dresse->txt}}</td>
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'rowID'=>$dresse->id,'modelName'=>'dresse'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'rowID'=>$dresse->id,'modelName'=>'dresse'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Dresses-->

                    </div>
                    <div class="col-md-6">
                        <!-- Inclusions -->
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
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'Information'=>$exclusion->id,'modelName'=>'exclusion'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'Information'=>$exclusion->id,'modelName'=>'exclusion'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Inclusions-->
                        <!-- Notes -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Notes Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Notes Text</th>
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->note as $note)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$note->txt}}</td>
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'rowID'=>$note->id,'modelName'=>'note'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'rowID'=>$note->id,'modelName'=>'note'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Notes-->
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


                <!-- Items Details -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-th"></i> Item Details</a> Table</h3>
                    </div>
                    <div class="box-body">
                        @if(count($Item->detail)>0)
                        <div class="row">
                            <div class="col-md-1"><span class="h4">Started</span></div>
                            <div class="col-md-1">{{ $Item->detail->started_at }}</div>
                            <div class="col-md-1"><span class="h4">Ended</span></div>
                            <div class="col-md-1">{{ $Item->detail->ended_at }}</div>
                            <div class="col-md-1"><span class="h4">Duration</span></div>
                            <div class="col-md-1">{{ $Item->detail->duration }}</div>
                            <div class="col-md-2">
                                <span class="h4"> Availability</span>
                            </div>
                            <div class="col-md-2">
                                @if(isset($Item->detail->availability))
                                @foreach(unserialize($Item->detail->availability) as $day)
                                <span class="label label-default">{{ $day }}</span>
                                @endforeach
                                @endif
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a href="{{ route('Detail.edit',['itemID'=>$Item->id,'detail'=>$Item->detail->id]) }}" class="btn btn-info"><i class="fa fa-hand-pointer-o"></i> Update Details</a>
                                </div>
                            </div>
                        </div>
                        @else
                        <form method="post" action="{{route('Detail.store',['itemID'=>$Item->id])}}">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Started At:</label>
                                            <div class="input-group">
                                                <input type="text" name="started_at" class="form-control timepicker">
                                                <div class="input-group-addon"> <i class="fa fa-clock-o"></i> </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Ended At:</label>
                                            <div class="input-group">
                                                <input type="text" name="ended_at" class="form-control timepicker">
                                                <div class="input-group-addon"> <i class="fa fa-clock-o"></i> </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Duration</label>
                                        <input type="number" class="form-control" value="" name="duration">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Availability</label>
                                        <select name="availability[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Day">
                                            <option>Saturday</option>
                                            <option>Sunday</option>
                                            <option>Monday</option>
                                            <option>Tuesday</option>
                                            <option>Thursday</option>
                                            <option>Wednesday</option>
                                            <option>Friday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label></label>
                                        <button class="btn btn-primary form-control"><i class="fa fa-paw"></i> Add Details</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
                <!-- Items Details End -->





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

@endsection