<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('meta_tags')
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        @yield('_extra_css')
        <link rel="stylesheet" href="{{asset('css/bootstrap-social.css')}}">
        <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>

        @if(session('expired'))
        <div class="alert alert-warning alert-dismissible" style="border: none; border-radius: 0px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <label>Oops</label> your session has expired</h4>
        </div>
        @endif
        @if(session('reviewSuccess'))
        <div class="alert alert-success alert-dismissible" style="border: none; border-radius: 0px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span class="review-success">
                <i class="fa fa-check"></i>
                <label>Thanks</label> for your review. it has been submitted to the <label>A2zTravelMarket</label> for approval</span>
        </div>
        @endif
        @include('Web.Layouts.login_form')
        <div class="row text-right main-header-holder">
            <div class="container">
                <a href="{{route('home')}}"><div class="main-nav-logo"></div></a>
                <ul class="list-inline top-header black-almost">
                    <li><a href="{{route('wishlist.index')}}"><i class="fa fa-heart"></i> Wishlist
                            @if (Auth::guard('customer')->check())

                            @if(\App\Http\Controllers\Web\WishlistController::customerWishlistCount()>0)
                            ({{\App\Http\Controllers\Web\WishlistController::customerWishlistCount()}})
                            <i class="fa fa-circle warning-icon"></i>
                            @endif
                            @else
                            @if(Session::has('wishlist') && Session::get('wishlist')->totalQty >0)
                            ({{Session::get('wishlist')->totalQty}})
                            <i class="fa fa-circle warning-icon"></i>
                            @endif
                            @endif
                        </a></li>
                    <li>
                        <a href="{{route('reservation.cart.show')}}"><i class="fa fa-shopping-cart"></i> Cart
                            {!! Session::has('cart')?"(".Session::get('cart')->totalQty.")":null !!}
                        </a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i> Help</a>
                        <ul class="dropdown-menu">
                            @foreach( App\Models\Topic::where('top',1)->orderBy('arrangement','asc')->get() as $top)
                            <li><a href="{{ route('topics.show',['topicsName'=>urlencode($top->name)]) }}">
                                    {{ $top->top_link }} </a></li>
                            @endforeach
                        </ul>
                    </li>
                    @if (Auth::guard('customer')->check())
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> {{Auth::guard('customer')->user()->name}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('customer.bookings')}}">Bookings</a></li>
                            <li><a href="{{route('customer.profile')}}">Settings</a></li>
                            <li><a href="{{route('customer.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li><a href="#" id="login_now"><i class="fa fa-user"></i> Login</a></li>
                    <li><a href="{{route('customer.register')}}"><i class="fa fa-user"></i> Sign up</a></li>
                    @endif

                </ul>
            </div>

        </div>

        <!-- header -->
        @yield('header-nav')
        <!-- end header -->
        <div class="row insider-holder">
            <div class="container">
                <!-- content -->
                @yield('content')
                <!-- content -->
            </div>
        </div>

        <!-- footer -->
        <!-- footer -->
        <div class="row footer">
            <div class="container" style="position: relative;">
                <div class="footer-show-toggle"><i class="fa fa-arrow-circle-down"></i> Show more</div>
                <div class="row">

                    @foreach( App\Models\Topic::where('footer',1)->orderBy('arrangement','desc')->limit(9)->get()->chunk(3) as $footerChunk)
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <ul>
                            @foreach($footerChunk as $footer)
                            @if($footer->name=="supplier")
                            <li><a href="{{route('supplierWeb.index')}}">{{ $footer->footer_link }} </a></li>
                            @else
                            <li><a href="{{ route('topics.show',['topicsName'=>urlencode($footer->name)]) }}">{{ $footer->footer_link }} </a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                    <div class="col-md-3">
                        <div class="row">
                            <span class="glyphicon glyphicon-envelope" style="margin-right: 10px; font-size: 20px;"></span>
                            Newsletter: Get the best travel deals delivered to your inbox!
                        </div>
                        <div class="row">
                            <form>
                                <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px; padding-right: 0px;">
                                    <input type="text" value="" class="form-control" placeholder="Your mail">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="padding-left: 5px;">
                                    <button class="btn btn-success" style="padding: 5px;"><i class="fa fa-check" style="font-size: 20px;"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="row footer-social-links">
                            <div class="col-md-12 col-sm-8 col-xs-8">
                                <a href="#"> <i class="fa fa-facebook"></i></a>
                                <a href="#"> <i class="fa fa-twitter"></i></a>
                                <a href="#"> <i class="fa fa-google-plus"></i></a>
                                <a href="#"> <i class="fa fa-pinterest-p"></i></a>
                                <a href="#"> <i class="fa fa-feed"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row footer-toggle toggle-off">
            <div class="container footer-final-links">
                <div class="row">
                    <div class="col-md-4">
                        <h1 class="refrence-title">Top 10 Countries</h1>
                        <ul class="refrence-list">
                            <li><a href="">Rome</a></li>
                            <li><a href="">Paris</a></li>
                            <li><a href="">London</a></li>
                            <li><a href="">Cairo</a></li>
                            <li><a href="">Sharm El Sheikh</a></li>
                            <li><a href="">New York</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h1 class="refrence-title">Top Destinations</h1>
                        <ul class="refrence-list">
                            <li><a href="">Egypt</a></li>
                            <li><a href="">England</a></li>
                            <li><a href="">Jordan</a></li>
                            <li><a href="">Malaysia</a></li>
                            <li><a href="">United States</a></li>
                            <li><a href="">New York</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h1 class="refrence-title">Must-See Attractions</h1>
                        <ul class="refrence-list">
                            <li><a href="">Egypt</a></li>
                            <li><a href="">England</a></li>
                            <li><a href="">Jordan</a></li>
                            <li><a href="">Malaysia</a></li>
                            <li><a href="">United States</a></li>
                            <li><a href="">New York</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center footer-rights">© 2017 A2ZTravelMarket.com All Rights Reserved</div>

        <script type="text/javascript" src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{asset('js/min.js')}}"></script>
        @yield('_extra_js')
    </body>
</html>
