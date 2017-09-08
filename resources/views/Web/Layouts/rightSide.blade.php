<div class="right-side-info">
    <div class="right-side-title">
        {{Vars::getVar('Why_Hurghadawonders.com')}} <i class="fa fa-question" aria-hidden="true"></i>
    </div>
    @foreach (App\MyModels\Admin\Topic::where('sidebar',1)->get() as $sidebar)
    <div class="right-side-item" onclick="location.href = '{{ route('topics.show',['topicsName'=>urlencode($sidebar->name)]) }}'">
        <span class="fa {{$sidebar->icon}} fa-3x"></span>
        <h2>{{$sidebar->sidebar_link}}</h2>
        <p>{{$sidebar->txt}} </p>
    </div>
    @endforeach
</div>
<div class="right_youtube">
    <iframe id="youtube" height="194" src="https://www.youtube.com/embed/1kd6-7mx-2c" frameborder="0" allowfullscreen></iframe>
</div>
<div class="row right-side-extras">
    <a href="">
        <img src="{{asset('images/extra.jpg')}}" style="width: 100%" alt="Holiday Extras">
    </a>
</div>
<div id="right_paypal">
    <img src="{{asset('images/paypal.png')}}" style="width: 100%" alt="paypal">
</div>
<!-- tripadvisor -->
<div class="right-trip-advisor">
    <div class="trip-advisor-holder">
        <div id="TA_rated315" class="TA_rated">
            <ul id="fqWdm218Q" class="TA_links DgAM4PoqV2bV">
                <li id="CL5vAxdzGj2" class="TaSbUsokfs"><a target="_blank" href="http://www.tripadvisor.com/"><img src="http://www.tripadvisor.com/img/cdsi/img2/badges/ollie-11424-2.gif" alt="TripAdvisor"/></a> </li>
            </ul>
        </div>
        <script  style="display:none">
<!--
            document.write('<script src="http://www.tripadvisor.com/WidgetEmbed-rated?lang=en_US&display_version=2&locationId=3723864&uniq=315"></S' + 'CRIPT>');

//-->
        </script>
    </div>
</div>

<!-- end tripadvisor -->