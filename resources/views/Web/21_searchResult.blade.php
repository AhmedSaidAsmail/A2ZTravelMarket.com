
@if(count($attractions)>0)
@foreach($attractions as $attraction)
<li><a href="{{route('attraction.show.available',['id'=>$attraction->id])}}" class="attraction_result">{{$attraction->name}}</a></li>
@endforeach
@endif

@if(count($cities)>0)
@foreach($cities as $city)
<li><a href="{{route('city.show.available',['id'=>$city->id])}}" class="city_result">{{$city->name}} governorate</a></li>
@endforeach
@endif
<script>
    var form = $("#search_form_dest");
    var ulResults = $("ul.search-results");
    var input = $("#attraction_search");
    var valueInput=$("#search_done");
    $("a.attraction_result").click(function (event) {
        event.preventDefault();
        ulResults.hide();
        form.attr('action', $(this).attr('href'));
        input.val($(this).text());
        valueInput.val($(this).text());
    });
    $("a.city_result").click(function (event) {
        event.preventDefault();
        ulResults.hide();
        form.attr('action', $(this).attr('href'));
        input.val($(this).text());
        valueInput.val($(this).text());
    });
</script>