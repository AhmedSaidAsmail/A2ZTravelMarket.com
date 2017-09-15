<!DOCTYPE html>
<html>
    <head>
        <title>Hurghada Wonders</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('meta_tags')
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        @yield('_extra_css')
        <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">

    </head>
    <body>
        @yield('extra-plugged-in')

        <!-- header -->
        @yield('header-nav')

        <!-- end header -->
        <!-- content -->
        @yield('content')

        <div class="row">
            <div class="container">
                <div class="home-title">
                    <div class="row-title">{{Vars::getVar('THINGS_TO_DO_IN')}}  <span>{{Vars::getVar('HURGHADA')}}</span>
                    </div>
                    <div class="row-line"></div>
                </div>
                <div class="row end-welcome">
                    @foreach(App\MyModels\Admin\Sort::where('recommended',1)->limit(4)->orderBy('arrangement')->get() as $city)
                    <a href="{{route('cities.show',['city'=>urlencode($city->name),'id'=>$city->id])}}">
                        <div class="col-md-3">
                            <div class="end-welcome-item">
                                <img class="img-abs-center" src="{{asset('images/sorts/thumb/'.$city->img)}}" alt="">
                                <span class="welcome-sort-name">{{$city->name}}</span>
                            </div>

                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- last welcome end -->
        <!-- footer start -->
        <div class="row footer">
            <div class="footer-show-toggle"><i class="fa fa-arrow-circle-up"></i> {{Vars::getVar('Show_more')}}</div>
            <div class="container">
                <div class="row footer-row">
                    <div class="col-md-4 footer-header-img">
                        <img src="{{asset('images/logo_footer.png')}}" alt="">
                    </div>
                    <div class="col-md-4 col-md-push-4" style="padding-top: 10px;">
                        <div class="form-group footer-search">
                            <input type="text" class="form-control" name="search" placeholder="Search the site">
                            <button>
                                <span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-search fa-stack-1x fa-inverse"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row footer-row footer-flex">
                    <div class="col-md-6 footer-price-quarntee">
                        <h2>{{Vars::getVar('Price_Beat_Guarantee')}}</h2>
                        <label>{{Vars::getVar('Gurantee_label')}}</label>
                        <p>{{Vars::getVar('Guarntee_text')}} .......
                            <a href="{{ route('topics.show',['topicsName'=>urlencode('guarntee')]) }}">{{Vars::getVar('click_here')}}</a></p>

                    </div>
                    <div class="col-md-3">
                        <div class="footer-contacts">
                            <span class="footer-title-span">{{Vars::getVar('Contact')}}</span>
                            <span>{{Vars::getVar('mobile')}}</span>
                            <a href="">
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <a href="">
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="footer-contacts">
                            <span class="footer-title-span">{{Vars::getVar('Connect')}}</span>
                            <span>{{Vars::getVar('Follow_us_on_these_sites')}}:</span>
                            <a href="{{Vars::getVar('facebook')}}">
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <a href="{{Vars::getVar('twitter')}}">
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <a href="{{Vars::getVar('youtube')}}">
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-youtube-play fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <a href="{{Vars::getVar('instagram')}}">
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <a href="{{Vars::getVar('tripadvisor')}}">
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-tripadvisor fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <a href="{{Vars::getVar('google')}}">
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- footer end -->
        <div class="row footer-alternate toggle-up">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 call-support">
                        <h2>{{Vars::getVar('UK_Tel')}}: {{Vars::getVar('Uk_tel_no')}}</h2>
                        {{Vars::getVar('Our_Experts_are_here_to_help!')}}
                    </div>
                    <div class="col-md-6 text-right">
                        <ul class="list-inline">
                            <li>
                                <a href="{{route('trnafsre.all')}}">
                                    <i class="fa fa-car fa-2x"></i>
                                    {{Vars::getVar('Airport_transfers')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('review.all')}}">
                                    <i class="fa fa-comments-o fa-2x"></i>
                                    {{Vars::getVar('GuestBook')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('topics.show',['topicsName'=>urlencode('contact')]) }}">
                                    <i class="fa fa-envelope-o fa-2x"></i>
                                    {{Vars::getVar('Click_to_Email')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cart')}}">
                                    <i class="fa fa-shopping-cart fa-2x"></i>
                                    {{Vars::getVar('View_Basket_Items')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center last-footer">
            © 2017 hurghadawonders.com All Rights Reserved
        </div>
        <script type="text/javascript" src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{asset('js/min.js')}}"></script>
        @yield('_extra_js')
    </body>
</html>
