<div class="row form-under-transfer form-transfer-show">
    <div class="container">
        <div style="display: none">
            <form id="getDestFrom" method="get" action="{{route('searchDist')}}">

            </form>
        </div>
        <form method="post" action="{{route('transfer.get')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="col-md-5">
                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon input-transfer">
                            <i class="fa fa-plane fa-lg"></i>
                        </div>
                        <div class="transfer-input-label">
                            <label>{{Vars::getVar('Which_airport_are_you_arriving_at?')}}</label>

                            <select  name="dist_from"class="form-control" id="dist_from_2">
                                <option>Eg. Sharm El Sheikh Airport</option>
                                @foreach(App\MyModels\Admin\Transfer::select('dist_from')->groupBy('dist_from')->get() as $transfer)
                                <option value="{{$transfer->dist_from}}">{{$transfer->dist_from}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-5">
                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon input-transfer">
                            <i class="fa fa-map-marker fa-lg"></i>
                        </div>
                        <div class="transfer-input-label">
                            <label>{{Vars::getVar('Where_do_you_want_to_go?')}}</label>
                            <select name="dist_to" class="form-control" id="dist_to">
                                <option>Eg. Nabq Hotels</option>
                            </select>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-2">
                <button class="btn btn-success btn-lg btn-block">{{Vars::getVar('Continue')}}</button>
            </div>
        </form>
    </div>
</div>