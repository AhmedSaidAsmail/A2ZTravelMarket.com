
<!-- header menu -->
<div class="row top-header">
    <div class="container text-right">
        <ul class="list-inline">
            <li><a href="{{route('home')}}"><i class="fa fa-home fa-lg top-home" aria-hidden="true"></i></a></li>
            <li><a href="{{route('trnafsre.all')}}"><i class="fa fa-car fa-lg" aria-hidden="true"></i> {{Vars::getVar('Transfer')}}</a></li>
            @foreach( App\MyModels\Admin\Topic::where('top',1)->orderBy('arrangement','asc')->get() as $top)
            <li><a href="{{ route('topics.show',['topicsName'=>urlencode($top->name)]) }}">
                    {{ $top->top_link }} </a></li>
            @endforeach
            <li><a href="{{route('review.all')}}"><i class="fa fa-comment fa-lg" aria-hidden="true"></i> {{Vars::getVar('GuestBook')}}</a></li>
        </ul>
    </div>
</div>
<!-- end header menu -->
<!-- navigator Menu -->
<div class="row main-nav-container main-nav-normal animated" id="main-nav">
    <div class="row main-nav-responsive">
        <div class="col-xs-3 mob-menu ">
            <div class="responsive-menu-icon-cover">
                <div class="responsive-menu-icon">
                    <div class="hamburger"></div>
                </div>

            </div>
        </div>

        <div class="logo-conatiner-responsive col-xs-6">

        </div>
        <div class="mob-cart col-xs-3">
            <a href=""><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge">
                    {{Session::has('cart')?Session::get('cart')->totalQty:0}}
                </span></a>
        </div>
    </div>
    <div class="container main-nav-item">
        <ul class="list-inline main-nav" id="main-nav-main">
            <li class="nav-logo">
                <div class="main-nav-logo"></div>
            </li>
            @foreach(App\MyModels\Admin\Sort::where('status',1)->limit(7)->orderBy('arrangement')->get() as $category)
            @if(isset($activeLink) && $activeLink==$category->id)
            <?php $class = ' active-link' ?>
            @else
            <?php $class = null ?>
            @endif
            <li class="nav-item{{ $class }}">
                <a href="{{route('cities.show',['city'=>urlencode($category->name),'id'=>$category->id])}}">{{$category->name}}</a>
                @if(count($category->items)>0)
                <div class="sub-nav">
                    <div class="sub-nav-container">
                        <div class="row">
                            <div class="col-md-6" style="position: relative; padding-right: 0px;">
                                <ul>
                                    @foreach($category->items as $itemmenu)

                                    <li>
                                        <a href="{{route('tour.show',['city'=>urlencode($category->name),'tour'=>urlencode($itemmenu->name),'id'=>$itemmenu->id])}}">
                                            {{$itemmenu->title}}</a>
                                        <div class="sub-nav-item-details">
                                            <div class="sub-nav-info">
                                                <div class="sub-nav-info-img">
                                                    <img class="img-abs-center" src="{{asset('images/items/thumb/'.$itemmenu->img)}}" alt="">
                                                </div>
                                                <h1>{{$itemmenu->title}}</h1>
                                                <p>
                                                    <?php
                                                    echo substr($itemmenu->intro, 0, 90);
                                                    ?>
                                                    ....
                                                </p>

                                            </div>

                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
                @endif
            </li>
            @endforeach
            <li class="nav-item"><a href="">Luxor</a></li>
            <li class="nav-item-right"><a href="{{ route('cart')}}">{{Session::has('cart')?Session::get('cart')->totalQty:0}}
                    {{Vars::getVar('My_Trips')}}
                    <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </li>
            <!-- information links -->
            <li class="nav-item-info"><a href="{{route('home')}}"><i class="fa fa-home fa-lg top-home" aria-hidden="true"></i> {{Vars::getVar('Home')}}</a></li>
            <li class="nav-item-info"><a href="{{route('trnafsre.all')}}"><i class="fa fa-car fa-lg" aria-hidden="true"></i> {{Vars::getVar('Transfer')}}</a></li>
            @foreach( App\MyModels\Admin\Topic::where('top',1)->orderBy('arrangement','asc')->get() as $top)
            <li class="nav-item-info"><a href="{{ route('topics.show',['topicsName'=>urlencode($top->name)]) }}">
                    {{ $top->top_link }} </a></li>
            @endforeach
            <li class="nav-item-info"><a href="{{route('review.all')}}"><i class="fa fa-comment fa-lg" aria-hidden="true"></i> {{Vars::getVar('GuestBook')}}</a></li>
        </ul>

    </div>
</div>
<!-- end navigator menu -->